<?php

namespace Tests\Feature;

use App\Classtype;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageClasstypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_classtype_list_in_classtype_index_page()
    {
        $classtype = factory(Classtype::class)->create();

        $this->loginAsUser();
        $this->visitRoute('classtypes.index');
        $this->see($classtype->name);
    }

    /** @test */
    public function user_can_create_a_classtype()
    {
        $this->loginAsUser();
        $this->visitRoute('classtypes.index');

        $this->click(__('classtype.create'));
        $this->seeRouteIs('classtypes.index', ['action' => 'create']);

        $this->submitForm(__('classtype.create'), [
            'name'        => 'Classtype 1 name',
            'description' => 'Classtype 1 description',
        ]);

        $this->seeRouteIs('classtypes.index');

        $this->seeInDatabase('classtypes', [
            'name'        => 'Classtype 1 name',
            'description' => 'Classtype 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Classtype 1 name',
            'description' => 'Classtype 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_classtype_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('classtypes.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_classtype_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('classtypes.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_classtype_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('classtypes.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_classtype_within_search_query()
    {
        $this->loginAsUser();
        $classtype = factory(Classtype::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('classtypes.index', ['q' => '123']);
        $this->click('edit-classtype-'.$classtype->id);
        $this->seeRouteIs('classtypes.index', ['action' => 'edit', 'id' => $classtype->id, 'q' => '123']);

        $this->submitForm(__('classtype.update'), [
            'name'        => 'Classtype 1 name',
            'description' => 'Classtype 1 description',
        ]);

        $this->seeRouteIs('classtypes.index', ['q' => '123']);

        $this->seeInDatabase('classtypes', [
            'name'        => 'Classtype 1 name',
            'description' => 'Classtype 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'Classtype 1 name',
            'description' => 'Classtype 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_classtype_name_update_is_required()
    {
        $this->loginAsUser();
        $classtype = factory(Classtype::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('classtypes.update', $classtype), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_classtype_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $classtype = factory(Classtype::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('classtypes.update', $classtype), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_classtype_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $classtype = factory(Classtype::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('classtypes.update', $classtype), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_classtype()
    {
        $this->loginAsUser();
        $classtype = factory(Classtype::class)->create();
        factory(Classtype::class)->create();

        $this->visitRoute('classtypes.index', ['action' => 'edit', 'id' => $classtype->id]);
        $this->click('del-classtype-'.$classtype->id);
        $this->seeRouteIs('classtypes.index', ['action' => 'delete', 'id' => $classtype->id]);

        $this->seeInDatabase('classtypes', [
            'id' => $classtype->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('classtypes', [
            'id' => $classtype->id,
        ]);
    }
}
