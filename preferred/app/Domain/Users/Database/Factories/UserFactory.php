<?php

namespace Preferred\Domain\Users\Database\Factories;

use Preferred\Domain\Users\Entities\User;
use Preferred\Infrastructure\Abstracts\AbstractModelFactory;
use Ramsey\Uuid\Uuid;

class UserFactory extends AbstractModelFactory
{
    protected $model = User::class;

    public function fields()
    {
        return [
            'id'                => Uuid::uuid4()->toString(),
            'email'             => strtolower(str_replace('-', '', Uuid::uuid4()->toString())) . '@gmail.com',
            'password'          => bcrypt('secretxxx'),
            'is_active'         => true,
            'email_verified_at' => now(),
        ];
    }

    public function states()
    {
        $this->factory->state($this->model, 'active', function () {
            return [
                'is_active' => true,
            ];
        });

        $this->factory->state($this->model, 'inactive', function () {
            return [
                'is_active' => false,
            ];
        });

        $this->factory->state($this->model, 'verified', function () {
            return [
                'verified_at' => now()->format('Y-m-d H:i:s.u'),
            ];
        });

        $this->factory->state($this->model, 'unverified', function () {
            return [
                'verified_at' => null,
            ];
        });

        $this->factory->state($this->model, 'email_verified', function () {
            return [
                'email_verified_at' => now()->format('Y-m-d H:i:s.u'),
            ];
        });

        $this->factory->state($this->model, 'email_unverified', function () {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
