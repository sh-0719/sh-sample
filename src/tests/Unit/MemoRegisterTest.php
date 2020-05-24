<?php

namespace Tests\Unit;

use App\Eloquents\Memo;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class MemoRegisterTest
 * @package Tests\Unit
 */
class MemoRegisterTest extends TestCase
{
    use DatabaseTransactions;

    // TODO: テストが動かない。後で動くようにする
    /**
     *
     */
    public function setUp()
    {
        parent::setUp();
        $user = \App\User::where('aaaa@a.com', 'aaaaaaaa')->first();
        $this->be($user);
    }

    /**
     * @param $input
     * @param $expected
     *
     * @dataProvider providerTrimInput
     */
    public function testTrimInput($inputContent, $expected)
    {
        $this->visit('memo.index')
            ->type($inputContent, 'content')
            ->press('追加')
            ->see('メモページです。');

        /** @var User|null $user */
        $user = \Auth::user();
        $memo = $user->memos()->orderBy('created_at', 'DESC')->first();

        $this->assertEquals($expected, $memo->content);
    }

    /**
     * @return array
     */
    public function providerTrimInput()
    {
        return [
            ['山田', '山田'],
            [' 山田 ', '山田'],    // 半角スペース
            ['　山田　', '山田'],  // 全角スペース
        ];
    }
}
