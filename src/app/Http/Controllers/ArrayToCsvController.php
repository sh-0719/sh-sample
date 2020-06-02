<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Class ArrayToCsvController
 * @package App\Http\Controllers
 */
class ArrayToCsvController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('array_to_csv.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function convertAndDownload(Request $request)
    {
        // todo: jsonファイルにも対応
        // todo: ファイル名をkeyの先頭にくっつけているけど、先頭に付けたいkeyがあれば自由に決められるように入力エリアを設ける
        // todo: DLできるcsvをDBに保管しておいて、自由にDLできるようにする？（ログインしてる場合だけ使える機能として）
        // todo: メソッド内の処理を別クラスに分ける（json対応時など、処理が複雑化した際にも見通しがよくなる）

        // todo: []の中が、正しく連想配列の形になっているかチェック
        $matchResult = preg_match('/\[(.|\s)+]/', $request->target);
        dd($matchResult);

        $file = $request->file('file');
        $fileNameWithoutExtension = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $target = require $file->getRealPath();
        unlink($file->getRealPath());

        $chainedKeys = [];
        $keyPrefix = $fileNameWithoutExtension;
        $this->addChainedKeysToArray($keyPrefix, $target, $chainedKeys);

        $completeKeysCsv = '';

        foreach ($chainedKeys as $line) {
            $completeKeysCsv .= $line . "\n";
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileNameWithoutExtension . '.csv"',
        ];

        return response()->make($completeKeysCsv, 200, $headers);
    }

    /**
     * @param string           $chainedKey
     * @param array|string|int $val
     * @param array            $completeKeys
     */
    private function addChainedKeysToArray(string $chainedKey, $val,array &$completeKeys)
    {
        if (is_array($val)) {
            foreach ($val as $currentKey => $item) {
                $newPrefix = $chainedKey . '.' . $currentKey;
                $this->addChainedKeysToArray($newPrefix, $item, $completeKeys);
            }
        } else {
            $completeKeys[] = $chainedKey;
        }
    }


}
