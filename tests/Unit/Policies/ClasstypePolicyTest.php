<?php

namespace Tests\Unit\Policies;

use App\Classtype;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClasstypePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_classtype()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Classtype));
    }

    /** @test */
    public function user_can_view_classtype()
    {
        $user = $this->createUser();
        $classtype = factory(Classtype::class)->create();
        $this->assertTrue($user->can('view', $classtype));
    }

    /** @test */
    public function user_can_update_classtype()
    {
        $user = $this->createUser();
        $classtype = factory(Classtype::class)->create();
        $this->assertTrue($user->can('update', $classtype));
    }

    /** @test */
    public function user_can_delete_classtype()
    {
        $user = $this->createUser();
        $classtype = factory(Classtype::class)->create();
        $this->assertTrue($user->can('delete', $classtype));
    }
}
