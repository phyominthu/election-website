<?php

namespace App;

use App\User;
use Jenssegers\Mongodb\Model;

/**
 * API User Token for Application Model.
 * 
 * @package Election API Website
 * @author Nyan Lynn Htut <naynlynnhtut@hexcores.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Token extends Model
{
	/**
     * The database collection used by the model.
     *
     * @var string
     */
    protected $collection = 'tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['app_key', 'app_id', 'token', 'user_id', 'disable'];

    /**
     * Relationship for application model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
    	return $this->belongsTo('App\Application', 'app_id');
    }
}