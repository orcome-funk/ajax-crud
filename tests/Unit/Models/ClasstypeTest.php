<?php

namespace Tests\Unit\Models;

use App\User;
use App\Classtype;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClasstypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_classtype_has_name_link_attribute()
    {
        $classtype = factory(Classtype::class)->create();

        $title = __('app.show_detail_title', [
            'name' => $classtype->name, 'type' => __('classtype.classtype'),
        ]);
        $link = '<a href="'.route('classtypes.show', $classtype).'"';
        $link .= ' title="'.$title.'">';
        $link .= $classtype->name;
        $link .= '</a>';

        $this->assertEquals($link, $classtype->name_link);
    }

    /** @test */
    public function a_classtype_has_belongs_to_creator_relation()
    {
        $classtype = factory(Classtype::class)->make();

        $this->assertInstanceOf(User::class, $classtype->creator);
        $this->assertEquals($classtype->creator_id, $classtype->creator->id);
    }
}
