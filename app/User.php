<?php

namespace App;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Laravel\Cashier\Billable;
use Cmgmyr\Messenger\Traits\Messagable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Auth;

class User extends Authenticatable
{
//    use EntrustUserTrait;
    use Billable;
    use Messagable;
    use Notifiable;
    use HasSlug;
//    use SoftDeletes;
//    use HasApiTokens, Notifiable;
    use EntrustUserTrait {
        can as traitCan;
        hasRole as traitHasRole;
    }
    use SoftDeletes { SoftDeletes::restore insteadof EntrustUserTrait; }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'username'])
            ->saveSlugsTo('slug');
    }

    public function staff()
    {
        return $this->hasOne('App\Staff');
    }

     /**
     * The roles that belong to the user.
     */
    public function roles()
    {
         return $this->belongsToMany('App\Role', 'role_user');

    }

     /**
     * The roles name that belong to the user.
     */
    public function getRoleName()
    {
         return $this->belongsTo('App\Role', 'role_id', 'id');

    }

    public function enrolled()
    {
        return $this->belongsToMany('App\LmsSeries', 'user_courses',
            'item_id', 'user_id')
             ->withPivot('item_name', 'item_price')
            ->withTimestamps();
    }

    public function courses()
    {
       // return $this->belongsToMany('App\PaymentCourses', 'user_id');
        return $this->belongsToMany('App\LmsSeries', 'user_courses',
            'user_id', 'item_id')->withPivot('item_name');
    }

    public function wishlists()
    {
        return $this->belongsToMany('App\LmsSeries', 'wishlists',
            'user_id', 'course_id');


    }

    /**
     * Returns the student record from students table based on the relationship
     * @return [type]        [Student Record]
     */
    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public static function getRecordWithSlug($slug)
    {
        return User::where('slug', '=', $slug)->first();
    }

    public function isChildBelongsToThisParent($child_id, $parent_id)
    {
        return User::where('id', '=', $child_id)
              ->where('parent_id','=',$parent_id)
              ->get()
              ->count();
    }

    public function getLatestUsers($limit = 5)
    {
        return User::where('role_id','=',getRoleData('student'))
                     ->orderBy('id','desc')
                     ->limit($limit)
                     ->get();
    }


     /**
      * This method accepts the user object from social login methods
      * Registers the user with the db
      * Sends Email with credentials list
      * @param  User   $user [description]
      * @return [type]       [description]
      */
     public function registerWithSocialLogin($receivedData = '')
     {
        $user        = new User();
        $password         = str_random(8);
        $user->password   = bcrypt($password);
        $slug             = $user->str_slug($receivedData->name);
        $user->username   = $slug;
        $user->slug       = $slug;

        $role_id        = getRoleData('student');

        $user->name  = $receivedData->name;
        $user->email = $receivedData->email;
        $user->role_id = $role_id;
        $user->login_enabled  = 1;
         if(!env('DEMO_MODE')) {
        $user->save();
        $user->roles()->attach($user->role_id);
        try{
            $user->notify(new \App\Notifications\NewUserRegistration($user,$user->email,$password));
        }
        catch(Exception $ex)
        {
            return $user;
        }

        }
       return $user;
     }

     /**
     * This method will return the user title
     * @return [type] [description]
     */
    public function getUserTitle()
    {
        return ucfirst($this->name);
    }


    public static function getUserSeleted($type='')
    {
        $user         = Auth::user();
        $preferences  = (array)json_decode($user->settings);
        // dd($preferences);
        $cats  = array();
        $lmscats  = array();
        if(isset($preferences['user_preferences'])){

        $cats         = $preferences['user_preferences']->quiz_categories;
        $lmscats      = $preferences['user_preferences']->lms_categories;

       }

        if($type == 'categories')
        return $cats;

        if($type == 'lms_categories')
          return count($lmscats);

       if($type == 'quizzes' && $cats)
           return Quiz::whereIn('category_id',$cats)->where('total_questions','>',0)->get()->count();

       return 0;

     }
}
