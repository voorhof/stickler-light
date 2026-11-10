<?php

use App\Filament\Filters\IsDiscountedFilter;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Filament\Facades\Filament;

beforeEach(function () {
    Filament::setCurrentPanel(Filament::getPanel('admin'));
    Filament::bootCurrentPanel();

    $this->adminUser = User::factory()->create();

    $permissions = collect([
        'access admin',
        'view products',
    ])->map(fn (string $name): Permission => Permission::create(['name' => $name]));

    $adminRole = Role::factory()->create(['name' => 'Admin']);
    $adminRole->givePermissionTo($permissions);

    $this->adminUser->assignRole($adminRole);

    $this->actingAs($this->adminUser);
});

it('has the correct default name', function () {
    $filter = IsDiscountedFilter::make();

    expect($filter->getName())->toBe('isDiscounted');
});

it('has the correct label', function () {
    $filter = IsDiscountedFilter::make();

    expect($filter->getLabel())->toBe(__('Is discounted'));
});
