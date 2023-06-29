<?php

namespace App\Services\Transactions;

use App\Models\User;
use App\Repositories\MasterClass\MasterClassRepository;
use Exception;
use Illuminate\Support\Str;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Transactions\TransactionsRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\Voucher\VoucherRepository;
use Illuminate\Support\Facades\DB;

class TransactionsServiceImplement extends Service implements TransactionsService
{

  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  protected $mainRepository;
  protected $masterClassRepository;
  protected $userRepository;
  private $duitkuConfig;
  private $voucherRepository;

  public function __construct(TransactionsRepository $mainRepository, MasterClassRepository $masterClassRepository, UserRepositoryImplement $userRepository, VoucherRepository $voucherRepository)
  {
    $this->mainRepository = $mainRepository;
    $this->masterClassRepository = $masterClassRepository;
    $this->userRepository = $userRepository;
    $this->voucherRepository = $voucherRepository;

    $this->duitkuConfig = new \Duitku\Config("d554deee413a416bed29883ec3b0420b", "DS15355");
    // false for production mode
    // true for sandbox mode
    $this->duitkuConfig->setSandboxMode(true);
    // set sanitizer (default : true)
    $this->duitkuConfig->setSanitizedMode(true);
    // set log parameter (default : true)
    $this->duitkuConfig->setDuitkuLogs(true);
  }

  public function create($data)
  {
    $user = Auth::user();

    $amount = (int) $data['amount'];

    DB::beginTransaction();

    try {
      if ($data['voucher']) {
        $getVoucher = $this->voucherRepository->showByCode([
          'master_class_id' => $data['master_class_id'],
          'voucher' => $data['voucher']
        ]);

        if ($getVoucher != null && $getVoucher->master_class->count() > 0 && $getVoucher->users->count() < 1 && $getVoucher->users_count < $getVoucher->capacity) {
          if ($getVoucher->discount_type == '%') {
            $discount = $amount * ($getVoucher->nominal / 100);
            $amount = $amount - $discount;
          } else {
            $amount = $amount - $getVoucher->nominal;
          }
          $this->voucherRepository->user_attach($getVoucher->id, $user->id);
        }
      }

      $paymentAmount      = $amount; // Amount
      $email              = $user->email; // your customer email
      $phoneNumber        = $user->phone ?? '-'; // your customer phone number (optional)
      $productDetails     = $data['master_class_name'];
      $merchantOrderId    = Str::uuid()->toString(); // from merchant, unique   
      $customerVaName     = $user->name; // display name on bank confirmation display
      $callbackUrl        = route('landing-page.callback'); // url for callback
      $returnUrl          = route('landing-page.return'); // url for redirect
      $expiryPeriod       = 120; // set the expired time in minutes

      // Costumer Detail
      $list = list($firstName, $lastName) = array_pad(explode(' ', trim($user->name)), 2, null);

      $customerDetail = array(
        'firstName'         => $list[0],
        'lastName'          => $list[count($list) - 1] ?? '-',
        'email'             => $email,
        'phoneNumber'       => $phoneNumber,
        // 'billingAddress'    => $user->address,
        // 'shippingAddress'   => $user->address
      );

      // Item Details
      $item1 = array(
        'name'      => $productDetails,
        'price'     => $paymentAmount,
        'quantity'  => 1
      );


      $itemDetails = array(
        $item1
      );

      $params = array(
        'paymentAmount'     => $paymentAmount,
        'merchantOrderId'   => $merchantOrderId,
        'productDetails'    => $productDetails,
        'customerVaName'    => $customerVaName,
        'email'             => $email,
        'phoneNumber'       => $phoneNumber,
        'itemDetails'       => $itemDetails,
        'customerDetail'    => $customerDetail,
        'callbackUrl'       => $callbackUrl,
        'returnUrl'         => $returnUrl,
        'expiryPeriod'      => $expiryPeriod
      );

      $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $this->duitkuConfig);

      header('Content-Type: application/json');

      $decode = json_decode($responseDuitkuPop, true);

      if ($decode['statusCode'] == "00") {

        $create = $this->mainRepository->create([
          'master_class_id' => $data['master_class_id'],
          'user_id' => $user->id,
          'invoice_number' => $merchantOrderId,
          'pay' => $paymentAmount,
          'status' => 'pennding'
        ]);

        if ($data['voucher']) {

          if($getVoucher->referal){
            $this->mainRepository->attach_saldo([
              'transaction_id' => $create->id,
              'user_id' => $getVoucher->referal->affiliate->user->id
            ]);
          }
          
        }

        DB::commit();

        return redirect($decode['paymentUrl']);
      } else {
        return redirect()->back()->withErrors('Gagal Melakukan Transaksi');
      }
    } catch (Exception $e) {
      DB::rollBack();
      return $e->getMessage();
    }
  }

  public function callback($request)
  {
    try {
      $callback = \Duitku\Pop::callback($this->duitkuConfig);

      header('Content-Type: application/json');
      $notif = json_decode($callback);

      if ($notif->resultCode == "00") {
        $masterClass = $this->mainRepository->show($request['merchantOrderId']);

        $this->userRepository->userClass($masterClass->id, $masterClass->class->where('mentee_count', '<=', 'capacity')->first()->id);
      }
    } catch (Exception $e) {
      http_response_code(400);
      return $e->getMessage();
    }
  }

  public function transactionCheck($request)
  {
    try {
      $merchantOrderId = $request['merchantOrderId'];
      $transactionList = \Duitku\Pop::transactionStatus($merchantOrderId, $this->duitkuConfig);

      header('Content-Type: application/json');
      $transaction = json_decode($transactionList);

      if ($transaction->statusCode == "00") {
        $masterClass = $this->mainRepository->show($merchantOrderId);
        $this->userRepository->userClass($masterClass->id, $masterClass->class->where('mentee_count', '<=', 'capacity')->first()->id);
        $this->mainRepository->updateStatus([
          'merchantOrderId' => $merchantOrderId,
          'status' => 'success'
        ]);
      } else if ($transaction->statusCode == "01") {
        $this->mainRepository->updateStatus([
          'merchantOrderId' => $merchantOrderId,
          'status' => 'pennding'
        ]);
      } else {
        $this->mainRepository->updateStatus([
          'merchantOrderId' => $merchantOrderId,
          'status' => 'failed'
        ]);
      }
      return redirect()->back();
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  public function return($request)
  {
    $merchantOrderId = $request['merchantOrderId'];
    if ($request['resultCode'] == "00") {
      $masterClass = $this->mainRepository->show($merchantOrderId);
      $this->userRepository->userClass($masterClass->id, $masterClass->class->where('mentee_count', '<=', 'capacity')->first()->id);
      $this->mainRepository->updateStatus([
        'merchantOrderId' => $merchantOrderId,
        'status' => 'success'
      ]);
    } else if ($request['resultCode'] == "02") {
      $this->mainRepository->updateStatus([
        'merchantOrderId' => $merchantOrderId,
        'status' => 'failed'
      ]);
    }

    return redirect()->route('landing-page.index');
  }

  public function transactionHistory()
  {
    return $this->mainRepository->transactionHistory();
  }
}
