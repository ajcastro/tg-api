<?php
$roles = Role::where('name', 'Administrator')->get();

foreach ($roles as $role) {
  dump($role->toArray());
  $role->assignAllPermissions();
}