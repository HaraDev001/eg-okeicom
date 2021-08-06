  @extends('okeicom.header')
  @section('title', '初めての方へ')
  @section('content')
<div id="container">
  <div class="midashi01">初めての方へ</div>
  <div class="center"><img src="/img/okeicom/first01.jpg" alt="メイン画像"></div>
  <p class="explain">『おけいcom』は、様々なジャンルのレッスンを自分の好きな時間に好きな場所で受講できるオンラインレッスンマッチングサイトです。</p>
  <p class="explain">インターネット環境とスマホ・タブレット・パソコンさえあれば、全国各地の講師の方々のレッスンが簡単に受けられます。 </p>
  <p class="explain">自分の目的やレベルに合ったレッスンを選べるのはもちろん、新しいジャンルのレッスンにも気軽にチャレンジできるので、今まで気が付かなかった自分の才能にも出会えるかも！</p>
  <div class="midashi01">おけいcomの特徴</div>
  <div class="center">
    <div class="feature"><img src="/img/okeicom/point01.png" width="60" alt="ポイント１"><br>
      <div class="midashi02">いつでもどこでも気軽に受講</div>
      <img src="/img/okeicom/first02.png" width="220" alt="メイン画像"><br>
      <div class="text">自分の好きな時に好きな場所で、色んなジャンルのレッスンを気軽に受けられます。会員登録はもちろん無料！</div>
    </div>
    <div class="feature"><img src="/img/okeicom/point02.png" width="60" alt="ポイント２"><br>
      <div class="midashi02">安心・安全なサポート</div>
      <img src="/img/okeicom/first03.png" width="220" alt="メイン画像"><br>
      <div class="text">レッスンの予約から終了まで、全てのやりとりはおけいcomを通すので、安全です。トラブルの際も運営が丁寧にサポートを行います。</div>
    </div>
    <div class="feature"><img src="/img/okeicom/point03.png" width="60" alt="ポイント３"><br>
      <div class="midashi02">スキルが身に付く＆生かせる</div>
      <img src="/img/okeicom/first04.png" width="220" alt="メイン画像"><br>
      <div class="text">１つのアカウントで受講者にも講師にもなることが可能。スキルを磨くと同時に、得意なことを生かして副収入も！</div>
    </div>
  </div>
  <div class="midashi01">おけいcomの利用方法</div>
  <article>
    <div class="text_content">
      <div class="midashi03">１．Zoomをインストール</div>
      <p>おけいcomのライブレッスンでは、オンラインビデオ通話ツール『Zoom』を利用します。<br>
        お手持ちのパソコンやスマートフォンにインストールするだけで、インターネットさえあれば、いつでもどこでもレッスンが受講できるようになります。<br>
		レッスンを開催・受講するには、ビデオとマイクが必要です。Zoomのインストール後、環境が整っているか事前のテストをおすすめします。<br>
        <a href="./zoom" class="btn-flat-border">Zoomインストール方法</a><a href="https://zoom.us/test" class="btn-flat-border">Zoomテスト</a></p>
    </div>
    <figure> <img src="{{url('/img/okeicom/youtube.jpg')}}" alt="Zoomインストール方法"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">２．無料会員登録</div>
      <p>おけいcomでオンラインレッスンを始めるには会員登録が必要です。もちろん、登録料は一切かかりませんので、安心して始めていただけます。一つのアカウントで、受講者としてはもちろん、講師としての活動も可能になります。<br>
        <a href="https://okeicom.com/sign-up" class="btn-flat-border">会員登録はコチラ</a> </p>
    </div>
    <figure> <img src="{{url('/img/okeicom/youtube.jpg')}}" alt="無料会員登録"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">３．講師検索・レッスン検索</div>
      <p>会員登録が完了したら、さっそくレッスンや講師を探してみましょう。レッスン一覧や講師一覧からは、ジャンルの絞り込みや並び替えができるので、スムーズに希望のレッスンを見つけることができます。<br>
        <a href="https://okeicom.com/lessons" class="btn-flat-border">レッスン一覧</a><a href="https://okeicom.com/teachers" class="btn-flat-border">講師一覧</a></p>
    </div>
    <figure> <img src="{{url('/img/okeicom/youtube.jpg')}}" alt="講師検索・レッスン検索"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">４．レッスン購入</div>
      <p>自分にピッタリのレッスンが見つかったら、レッスンを予約しましょう。<br>
        クレジットカード情報を入力して、「決済する」をクリックすると予約完了です。予約したレッスンは、メニューの「受講予定レッスン」からいつでも確認できます。<br>
        レッスンのキャンセルは開始時刻の24時間前までは無料です。それ以降は、各講師が設定したキャンセルポリシーに準じます。講師へ質問等がある場合は、直接メッセージのやり取りも可能です。<br>
        <a href="https://okeicom.com/cancel-user" class="btn-flat-border">キャンセルポリシー</a> </p>
    </div>
    <figure> <img src="{{url('/img/okeicom/youtube.jpg')}}" alt="レッスン購入"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">５．レッスン受講</div>
      <p>レッスン開始時刻になると、レッスンページに「参加する」ボタンが現れます。（表示されていない場合は、一度ページを更新してください。）ボタンを押すと、zoomが自動的に立ち上がり、レッスンが始まります。 </p>
    </div>
    <figure> <img src="{{url('/img/okeicom/youtube.jpg')}}" alt="レッスン受講"> </figure>
  </article>
  <article>
    <div class="text_content">
      <div class="midashi03">６．レビュー投稿</div>
      <p>レッスンが終了したら、ご登録いただいたメールアドレスにメールが届きます。こちらのメールからレビュー投稿が可能となります。皆さんのご意見や感想は、講師の方にとって学びや励みにもなります。ぜひご協力ください。</p>
    </div>
    <figure> <img src="{{url('/img/okeicom/youtube.jpg')}}" alt="レビュー投稿"> </figure>
  </article>
  <div class="midashi01">おけいcomの講師紹介</div>
  <p class="explain">おけいcomでは、様々なジャンルの講師の方が活躍中です。<br>
    「どんな講師の方がいるのかな？」「どのようなレッスンが受けられるのかな？」と、不安に感じる方もいらっしゃるかと思います。講師の人柄や実際のレッスンの雰囲気が分かる講師紹介動画もぜひご覧ください！</p>
  <div class="youtube">
    <iframe width="280" height="158" src="https://www.youtube.com/embed/n5TnsOZPJuw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="youtube">
    <iframe width="280" height="158" src="https://www.youtube.com/embed/MSzSQ3Tbrsw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="youtube">
    <iframe width="280" height="158" src="https://www.youtube.com/embed/AFaFJSGHTLg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
  </div>
  <div class="midashi01">困ったときは・・・</div>
  <div class="btn-center"> <a href="https://okeicom.com/faq-user">
    <div class="btn1">よくある質問</div>
    </a> <a href="https://okeicom.com/contact/">
    <div class="btn2">お問合わせ</div>
    </a> </div>
</div>
@endsection