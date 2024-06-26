<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $uuid
 * @property int $user_id
 * @property string $data
 * @property int $decode_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property \App\Models\DecodeType|null $type
 * @property-read mixed $base64
 * @property-read mixed $json
 * @property-read mixed $print_r
 * @property-read mixed $var_export
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\DecodeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Decode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Decode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Decode query()
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereDecodeTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Decode whereUuid($value)
 */
	class Decode extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Decode> $decodes
 * @property-read int|null $decodes_count
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DecodeType whereUuid($value)
 */
	class DecodeType extends \Eloquent {}
}

namespace App\Models{
/**
 *
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property string|null $github_id
 * @property string|null $github_token
 * @property string|null $github_refresh_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Decode> $decodes
 * @property-read int|null $decodes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGithubToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUuid($value)
 */
	class User extends \Eloquent {}
}
