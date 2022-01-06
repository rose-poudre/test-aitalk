<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Message;
use Auth;
use App\Models\User;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::getAllOrderByUpdated_at();
        return view('message.index', [
        'messages' => $messages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
        'message' => 'required | max:191',
        'reply' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
        return redirect()
          ->route('message.create')
          ->withInput()
          ->withErrors($validator);
        }
        
        // 🔽 編集 フォームから送信されてきたデータとユーザIDをマージし，DBにinsertする
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $result = Message::create($request->all());
        // ルーティング「message.index」にリクエスト送信（一覧ページに移動）
        // return redirect()->route('message.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        return view('message.show', ['message' => $message]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::find($id);
        return view('message.edit', ['message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'message' => 'required | max:191',
            'reply' => 'required',
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
              ->route('message.edit', $id)
              ->withInput()
              ->withErrors($validator);
        }
        //データ更新処理
        // updateは更新する情報がなくても更新が走る（updated_atが更新される）
        $result = Message::find($id)->update($request->all());
        // fill()save()は更新する情報がない場合は更新が走らない（updated_atが更新されない）
        // $result = Message::find($id)->fill($request->all())->save();
        return redirect()->route('message.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Message::find($id)->delete();
        return redirect()->route('message.index');
    }
    
    public function mydata()
    {
        // Userモデルに定義した関数を実行する．
        $messages = User::find(Auth::user()->id)->mymessages;
        return view('message.index', [
          'messages' => $messages
        ]);
    }
    
    public function favorite()
    {
        $messages = Message::getAllOrderByUpdated_at();
        return view('message.favorite', [
        'messages' => $messages
        ]);
    }
}
