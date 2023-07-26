@extends('layouts.app')

@section('content')

 <body>
    
     
     <main>
         <article>
             <div>                
                 <h1>投稿一覧</h1>
                 <div>
                     <a href="{{ route('contents.create') }}">新規投稿</a>                                   
                 </div>
             </div>
         </article>
     </main>
 
  
 </body>
 
 @endsection