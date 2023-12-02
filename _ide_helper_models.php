<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\ColoringBook
 *
 * @property int $id
 * @property string $title
 * @property string $subscription_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook query()
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook whereSubscriptionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ColoringBook withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 */
	class ColoringBook extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\ListeningBook
 *
 * @property int $id
 * @property string $title
 * @property string $subscription_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Page|null $page
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook query()
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook whereSubscriptionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|ListeningBook withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 */
	class ListeningBook extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string $pageable_type
 * @property int $pageable_id
 * @property string $text
 * @property string $audio_id
 * @property string|null $audio_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $book
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAudioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereAudioUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page wherePageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\StoryBook
 *
 * @property int $id
 * @property string $title
 * @property string $subscription_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Page> $pages
 * @property-read int|null $pages_count
 * @property \Illuminate\Database\Eloquent\Collection<int, \Spatie\Tags\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook query()
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook whereSubscriptionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook withAllTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook withAnyTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|StoryBook withoutTags(\ArrayAccess|\Spatie\Tags\Tag|array|string $tags, ?string $type = null)
 */
	class StoryBook extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models{
/**
 * App\Models\SubscriptionPlan
 *
 * @property int $id
 * @property string $st_price
 * @property string $name
 * @property float $price
 * @property int $trial_days
 * @property array $info
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereStPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereTrialDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereUpdatedAt($value)
 */
	class SubscriptionPlan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $fname
 * @property string|null $lname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $address
 * @property string|null $zip
 * @property string|null $country
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $stripe_id
 * @property string|null $pm_type
 * @property string|null $pm_last_four
 * @property string|null $trial_ends_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Cashier\Subscription> $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User hasExpiredGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User onGenericTrial()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePmLastFour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePmType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTrialEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZip($value)
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

