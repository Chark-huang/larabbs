<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            env('APP_URL') . '/static/avatar/boy1.png',
            env('APP_URL') . '/static/avatar/boy2.png',
            env('APP_URL') . '/static/avatar/boy3.png',
            env('APP_URL') . '/static/avatar/girl1.png',
            env('APP_URL') . '/static/avatar/girl2.png',
            env('APP_URL') . '/static/avatar/girl3.png',
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index) use($faker, $avatars){
                //从头像数组中随机取一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见, 并将数据集合转化为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        //单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Chark';
        $user->email = 'chark@example.com';
        $user->avatar = env('APP_URL') . '/static/avatar/tutu.jpg';
        $user->save();

        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');
    }
}
