<?php
/**
 * The MIT License (MIT)
 *
 * WebCBT - Web based Cognitive Behavioral Therapy tool
 *
 * http://webcbt.github.io
 *
 * Copyright (c) 2014 Prashant Shah <pshah.webcbt@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class Cbt extends Eloquent {

	/* use SoftDeletingTrait; */

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cbts';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
        protected $hidden = ['user_id', 'created_at', 'updated_at', 'deleted_at'];

	/**
	 * The attributes that can be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['tag_id', 'date', 'situation'];

	/**
	 * The attributes that cannot be mass assigned
	 *
	 * @var array
	 */
	protected $guarded = ['id', 'user_id', 'is_resolved',
		'created_at', 'updated_at', 'deleted_at'];

	/* Model relationships */

	public function cbtThoughts()
	{
		return $this->hasMany('CbtThought');
	}

	public function cbtFeelings()
	{
		return $this->hasMany('CbtFeeling');
	}

	public function cbtSymptoms()
	{
		return $this->hasMany('CbtSymptom');
	}

	public function cbtBehaviours()
	{
		return $this->hasMany('CbtBehaviour');
	}

	public function tag()
	{
		return $this->belongsTo('Tag');
	}

	public static function boot()
	{
		parent::boot();

		/* Hook into save event, setup event bindings */
		Cbt::saving(function($content)
		{
			/* Set user id on save */
			$content->user_id = Auth::id();
		});
	}

	public function scopeCuruser($query)
	{
		return $query->where('user_id', '=', Auth::id());
	}

}
