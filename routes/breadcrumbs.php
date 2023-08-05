<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\Facades\DB;

// Superadmin
Breadcrumbs::for('dashboard-superadmin', function ($trail) {
    $trail->push('Dashboard', route('superadmin.dashboard'));
});

// Event
Breadcrumbs::for('event', function ($trail) {
    $trail->parent('dashboard-superadmin');
    $trail->push('Events', route('superadmin.events.index'));
});
// Event > Create
Breadcrumbs::for('event.create', function ($trail) {
    $trail->parent('event');
    $trail->push('Create', route('superadmin.events.create'));
});
// Event > Edit > Event Name
Breadcrumbs::for('event.edit', function ($trail, $event) {
    $trail->parent('event');
    $trail->push('Edit / '.$event->name, route('superadmin.events.edit', ['id' => $event->id]));
});

// Master Class
Breadcrumbs::for('master-class', function ($trail) {
    $trail->parent('dashboard-superadmin');
    $trail->push('Master Class', route('superadmin.master-class.index'));
});
// Master Class > Create
Breadcrumbs::for('master-class.create', function ($trail) {
    $trail->parent('master-class');
    $trail->push('Create', route('superadmin.master-class.create'));
});
// Master Class > Edit > Master Class Name
Breadcrumbs::for('master-class.edit', function ($trail, $master_class) {
    $trail->parent('master-class');
    $trail->push('Edit / '.$master_class->name, route('superadmin.master-class.edit', ['id' => $master_class->id]));
});

// Voucher
Breadcrumbs::for('voucher', function ($trail) {
    $trail->parent('dashboard-superadmin');
    $trail->push('Voucher', route('superadmin.vouchers.index'));
});
// Voucher > Create
Breadcrumbs::for('voucher.create', function ($trail) {
    $trail->parent('voucher');
    $trail->push('Create', route('superadmin.vouchers.create'));
});
// Voucher > Edit > Voucher Name
Breadcrumbs::for('voucher.edit', function ($trail, $voucher) {
    $trail->parent('voucher');
    $trail->push('Edit / '.$voucher->voucher_code, route('superadmin.vouchers.edit', ['id' => $voucher->id]));
});

// Certificate
Breadcrumbs::for('certificate', function ($trail) {
    $trail->parent('dashboard-superadmin');
    $trail->push('Certificate', route('superadmin.certificate.index'));
});
// Certificate > Create
Breadcrumbs::for('certificate.create', function ($trail) {
    $trail->parent('certificate');
    $trail->push('Create', route('superadmin.certificate.create'));
});
// Certificate > Edit > Certificate Code
Breadcrumbs::for('certificate.edit', function ($trail, $certificate) {
    $trail->parent('certificate');
    $trail->push('Edit / '.$certificate->certificate_number, route('superadmin.certificate.edit',['id' => $certificate->id]));
});

// Galery
Breadcrumbs::for('galery', function ($trail) {
    $trail->parent('dashboard-superadmin');
    $trail->push('Galery', route('superadmin.certificate.index'));
});
// Galery > Create
Breadcrumbs::for('galery.create', function ($trail) {
    $trail->parent('galery');
    $trail->push('Create', route('superadmin.galery.create'));
});
// Galery > Edit > Galery Name
Breadcrumbs::for('galery.edit', function ($trail, $galery) {
    $trail->parent('galery');
    $trail->push('Edit / '.$galery->title, route('superadmin.galery.edit', ['id' => $galery->id]));
});

// User Management
Breadcrumbs::for('user-management', function ($trail, $role) {
    $trail->parent('dashboard-superadmin');
    $trail->push($role, route('superadmin.manage.users', ['role_name' => $role]));
});
// User Management > Create
Breadcrumbs::for('user-management.create', function ($trail, $role) {
    $trail->parent('dashboard-superadmin');
    $trail->push('Create / '.$role, route('superadmin.manage.users.create', ['role_name' => $role]));
});

// Mentor
Breadcrumbs::for('dashboard-mentor', function ($trail) {
    $trail->push('Dashboard', route('mentor.dashboard'));
});

// Class
Breadcrumbs::for('mentor-class', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Kelas', route('mentor.class.index'));
});
// Class > Create
Breadcrumbs::for('mentor-class.detail', function ($trail, $class) {
    $trail->parent('mentor-class');
    $trail->push('Show / '.$class->name, route('mentor.class.show', ['id' => $class->id]));
});

// Presence
Breadcrumbs::for('mentor-presence', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Presensi', route('mentor.presence.index'));
});
// Presence > Create
Breadcrumbs::for('mentor-presence.create', function ($trail) {
    $trail->parent('mentor-presence');
    $trail->push('Buat Presensi', route('mentor.presence.create'));
});
// Presence > Edit
Breadcrumbs::for('mentor-presence.edit', function ($trail, $presence) {
    $trail->parent('mentor-presence');
    $trail->push('Edit / '.$presence->name, route('mentor.presence.edit', ['id' => $presence->id]));
});
// Presence > Detail
Breadcrumbs::for('mentor-presence.detail', function ($trail, $presence) {
    $trail->parent('mentor-presence');
    $trail->push($presence->name, route('mentor.presence.detail', ['id' => $presence->id]));
});

// Task
Breadcrumbs::for('mentor-task', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Tugas', route('mentor.tasks.index'));
});
// Task > Create
Breadcrumbs::for('mentor-task.create', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Buat Tugas', route('mentor.tasks.create'));
});
// Task > Edit
Breadcrumbs::for('mentor-task.edit', function ($trail, $task) {
    $trail->parent('dashboard-mentor');
    $trail->push('Edit / '.$task->name, route('mentor.tasks.edit', $task->id));
});
// Task > Evaluation
Breadcrumbs::for('mentor-task.evaluation', function ($trail, $task) {
    $trail->parent('dashboard-mentor');
    $trail->push('Evaluation / '.$task->name, route('mentor.tasks.evaluation', $task->id));
});

// Material
Breadcrumbs::for('mentor-material', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Materi', route('mentor.materials.index'));
});
// Material > Material Name
Breadcrumbs::for('mentor-material.detail', function ($trail, $material) {
    $trail->parent('mentor-material');
    $trail->push($material->name, route('mentor.materials.index'));
});
// Material > Create
Breadcrumbs::for('mentor-material.create', function ($trail, $id, $class_id) {
    $trail->parent('mentor-material');
    $trail->push('Tambah Materi', route('mentor.materials.create', ['id' => $id, 'classId' => $class_id]));
});
// Material > Edit > Name
Breadcrumbs::for('mentor-material.edit', function ($trail, $material, $class_id, $master_class_id) {
    $trail->parent('mentor-material');
    $trail->push('Ubah Materi / '. $material->name, route('mentor.materials.edit', ['classId' => $class_id, 'id' => $master_class_id, 'material_id' => $material->id]));
});

// Scoring
Breadcrumbs::for('mentor-scoring', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Kelas', route('mentor.scoring.index'));
});
// Scoring > Class Name
Breadcrumbs::for('mentor-scoring.detail', function ($trail, $class) {
    $trail->parent('mentor-scoring');
    $trail->push($class->name, route('mentor.scoring.mentee', ['id' => $class->id]));
});
// Scoring > Class Name > User Name
Breadcrumbs::for('mentor-scoring.user', function ($trail, $class_id, $user, $master_class_id) {
    $class = DB::table('class')->where('id', $class_id)->first();
    $trail->parent('mentor-scoring.detail', $class);
    $trail->push($user->name, route('mentor.scoring.mentee.input', ['class_id' => $class_id, 'masterClass_id' => $master_class_id, 'mente_id' => $user->id]));
});

// Certificate
Breadcrumbs::for('mentor-certificate', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Sertifikat', route('mentor.certificate.index'));
});
// Certificate > Class Name
Breadcrumbs::for('mentor-certificate.mentee', function ($trail, $class) {
    $trail->parent('mentor-certificate');
    $trail->push($class->name, route('mentor.certificate.class', ['id' => $class->id]));
});

// Mentee List
Breadcrumbs::for('mentor-mentee-list', function ($trail) {
    $trail->parent('dashboard-mentor');
    $trail->push('Daftar Mentee', route('mentor.mentee-management.index'));
});
// Mentee List > User Name
Breadcrumbs::for('mentor-mentee-list.user', function ($trail, $user) {
    $trail->parent('mentor-mentee-list');
    $trail->push($user->name, route('mentor.mentee-management.activity', ['user_id' => $user->id]));
});

// Mentee
Breadcrumbs::for('dashboard-mentee', function ($trail) {
    $trail->push('Dashboard', route('mentee.dashboard'));
});

// Class
Breadcrumbs::for('mentee-class', function ($trail) {
    $trail->parent('dashboard-mentee');
    $trail->push('Kelas Saya', route('mentee.class.index'));
});
// Class > Class Name
Breadcrumbs::for('mentee-class.detail', function ($trail, $class) {
    $trail->parent('mentee-class');
    $trail->push($class->name, route('mentee.class.show', $class->id));
});

// Presence
Breadcrumbs::for('mentee-presence', function ($trail) {
    $trail->parent('dashboard-mentee');
    $trail->push('Daftar Presensi', route('mentee.presence.index'));
});

// Task
Breadcrumbs::for('mentee-task', function ($trail) {
    $trail->parent('dashboard-mentee');
    $trail->push('Daftar Tugas', route('mentee.tasks.index'));
});
// Task > Task Name
Breadcrumbs::for('mentee-task.detail', function ($trail, $task) {
    $trail->parent('mentee-task');
    $trail->push($task->name, route('mentee.tasks.show', $task->id));
});
?>
