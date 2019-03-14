<?php

namespace Tests\Feature;

use App\StudentClass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageStudentClassTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_student_class_list_in_student_class_index_page()
    {
        $studentClass = factory(StudentClass::class)->create();

        $this->loginAsUser();
        $this->visitRoute('student_classes.index');
        $this->see($studentClass->name);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'StudentClass 1 name',
            'description' => 'StudentClass 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_create_a_student_class()
    {
        $this->loginAsUser();
        $this->visitRoute('student_classes.index');

        $this->click(__('student_class.create'));
        $this->seeRouteIs('student_classes.create');

        $this->submitForm(__('student_class.create'), $this->getCreateFields());

        $this->seeRouteIs('student_classes.show', StudentClass::first());

        $this->seeInDatabase('student_classes', $this->getCreateFields());
    }

    /** @test */
    public function validate_student_class_name_is_required()
    {
        $this->loginAsUser();

        // name empty
        $this->post(route('student_classes.store'), $this->getCreateFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_class_name_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // name 70 characters
        $this->post(route('student_classes.store'), $this->getCreateFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_class_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('student_classes.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'name'        => 'StudentClass 1 name',
            'description' => 'StudentClass 1 description',
        ], $overrides);
    }

    /** @test */
    public function user_can_edit_a_student_class()
    {
        $this->loginAsUser();
        $studentClass = factory(StudentClass::class)->create(['name' => 'Testing 123']);

        $this->visitRoute('student_classes.show', $studentClass);
        $this->click('edit-student_class-'.$studentClass->id);
        $this->seeRouteIs('student_classes.edit', $studentClass);

        $this->submitForm(__('student_class.update'), $this->getEditFields());

        $this->seeRouteIs('student_classes.show', $studentClass);

        $this->seeInDatabase('student_classes', $this->getEditFields([
            'id' => $studentClass->id,
        ]));
    }

    /** @test */
    public function validate_student_class_name_update_is_required()
    {
        $this->loginAsUser();
        $student_class = factory(StudentClass::class)->create(['name' => 'Testing 123']);

        // name empty
        $this->patch(route('student_classes.update', $student_class), $this->getEditFields(['name' => '']));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_class_name_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $student_class = factory(StudentClass::class)->create(['name' => 'Testing 123']);

        // name 70 characters
        $this->patch(route('student_classes.update', $student_class), $this->getEditFields([
            'name' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('name');
    }

    /** @test */
    public function validate_student_class_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $student_class = factory(StudentClass::class)->create(['name' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('student_classes.update', $student_class), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_student_class()
    {
        $this->loginAsUser();
        $studentClass = factory(StudentClass::class)->create();
        factory(StudentClass::class)->create();

        $this->visitRoute('student_classes.edit', $studentClass);
        $this->click('del-student_class-'.$studentClass->id);
        $this->seeRouteIs('student_classes.edit', [$studentClass, 'action' => 'delete']);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('student_classes', [
            'id' => $studentClass->id,
        ]);
    }
}
