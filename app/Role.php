<?php 

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public $timestamps = true;

    protected $table = 'roles';

	protected $fillable = ['name', 'display_name', 'description', 'role_permission'];

	public static function getRoles()
	{
		return Role::all();		
	}

	 /**
     * The users that belong to the role.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'role_user');
    }

    public static function getRoleId($role_name)
    {
    	return Role::where('name', '=', $role_name)->get()->first();
    }


    public static function getPermission()
    {
        return Permission::All();
    }


    public static function getPermissionOnID($Role_id, $PermissionTxt)
    {
        $response = true;

        $resData = \App\Role::find($Role_id);

        if($resData->role_permission == NULL) {
            return $response;
        }

        if(strpos($resData->role_permission, $PermissionTxt) !== FALSE) {
            return $response;
        }

        return false;
    }

}