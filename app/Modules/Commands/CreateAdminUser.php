<?php

namespace App\Modules\Commands;

use App\Modules\Entities\User\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create admin user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $this->line($email);
        $user = new User();
        $passwd = $this->secret('Input the password');
        if (empty($passwd)) {
            $passwd = Str::random(8);
        }
        $data = [
            'name' => 'admin',
            'email' => $email,
            'password' => Hash::make($passwd)
        ];
        $user->fill($data);
        $user->save();
        $data['password'] = $passwd;
        $this->table(['name', 'email', 'password'], [$data]);
        return Command::SUCCESS;
    }
}
