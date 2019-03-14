<?php

namespace App;

use App\User;
use App\Classtype;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = ['name', 'class_id', 'description', 'creator_id'];

    public function getNameLinkAttribute()
    {
        $title = __('app.show_detail_title', [
            'name' => $this->name, 'type' => __('student_class.student_class'),
        ]);
        $link = '<a href="'.route('student_classes.show', $this).'"';
        $link .= ' title="'.$title.'">';
        $link .= $this->name;
        $link .= '</a>';

        return $link;
    }

    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function classType()
    {
        return $this->belongsTo(Classtype::class, 'class_id');
    }
}
