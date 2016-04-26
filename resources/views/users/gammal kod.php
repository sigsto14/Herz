              <?php
              /* behöver fylla en array senare */
              $array = '';
              /* hämtar playlists*/
              $playlists = DB::table('playlists')->where('userID', '=', $user->userID)->orderBy('created_at', 'ASC')->take(5)->get();
              /*kollar hur många resultat som går att ta ut så att vi kan använda detta i if-satser senare */
              $count = DB::table('playlists')->where('userID', '=', $user->userID)->orderBy('created_at', 'ASC')->take(5)->count();
              /* en variabel för o kolla om det är tomt */
              $playlistsCheck = DB::table('playlists')->where('userID', '=', $user->userID)->first();
              /* en foreach loop för att sätta in värden i vår array */
              foreach($playlists as $playlist){
              if($playlist->listID == $playlistsCheck->listID){
              /* det första värdet ska ej ha , */
              $array .= $playlist->listID;
              }
              else{
              /* de andra värdena ska skiljas med , */
              $array .= ',' . $playlist->listID;
              }
              }
              /* gör en array av värdena vi satt in i variabeln för arrayen */
              $lists = array_values(explode(',',$array,10));
              $li = '';
              /* med hjälp av att kolla hur många resultat vi fick gör vi variabler av värdena i arrayen */
              /* variabler för var resultat (max 5) */
              /* detta för att javascript och ny xml ej fungerar med foreach loop och id'n */
              if($count > 0){
              $listID1 = $lists[0]; 
              $list1 = DB::table('playlists')->where('listID', '=', $listID1)->first();
              $li .= '<li role="presentation" class="active"><a href="#' . $list1->listTitle . '" role="tab" data-toggle="tab" id="' . $list1->listTitle .'">' . $list1->listTitle . '</a></li>';
              }
              if($count > 1){
              $listID2 = $lists[1];
              $list2 = DB::table('playlists')->where('listID', '=', $listID2)->first();
              $li .= '<li role="presentation"><a href="#' . $list2->listTitle . '" role="tab" data-toggle="tab" id="' . $listID2 . '">' . $list2->listTitle . '</a></li>';
              }
              if($count > 2){
              $listID3 = $lists[2];
              $list3 = DB::table('playlists')->where('listID', '=', $listID3)->first();
              $li .= '<li role="presentation"><a href="#' . $list3->listTitle . '" role="tab" data-toggle="tab" id="' . $listID3 . '">' . $list3->listTitle . '</a></li>';
              }
              if($count > 3){
              $listID4 = $lists[3];
              $list4 = DB::table('playlists')->where('listID', '=', $listID4)->first();
              $li .= '<li role="presentation"><a href="#' . $list4->listTitle . '" role="tab" data-toggle="tab" id="' . $listID4 . '">' . $list4->listTitle . '</a></li>';
              }
              if($count > 4){
              $listID5 = $lists[4];
              $list5 = DB::table('playlists')->where('listID', '=', $listID5)->first();
              $li .= '<li role="presentation"><a href="#' . $list5->listTitle . '" role="tab" data-toggle="tab" id="' . $listID5 . '">' . $list5->listTitle . '</a></li>';
              }
              $lo = html_entity_decode($li, ENT_QUOTES);
              ?>
              @if(is_null($playlistsCheck))
              <p>Oj oj, här var det tomt! {{ $user->username }} har inga spellistor än</p>
              @else
              </div>
                <div class="col-lg-8"  id="tabus"> 
                <ul class="nav nav-tabs" role="tablist" >
                <?php echo $lo  ?>
                </ul>
                @if($count > 0)
                 <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="{{ $list1->listTitle }}">
                    <!-- lite länkar o lista -->
                    <h2><a href="http://localhost/Herz/public/playlist/{{ $list1->listID }}">{{ $list1->listTitle }}</a></h2>
                    <br>
                    <h4>Beskrivning</h4>
                    <br>
                    <p>{{ $list1->listDescription }}</p>
                    <div class="hidden" id="closePlayer">
                      <button type="button" class="btn btn-default btn-lg">
                        <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                      </button>
                      <!-- en box som vi ska ladda in värden i senare -->
                    </div>
                    <form action="" method="put" name="play1" id="play">
                      <input type="hidden" name="listID" value="{{ $list1->listID }}" id="listID">
                      <button type="submit" class="btn btn-default btn-lg" id="play">
                        <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                      </button>
                    </form> 
                    <div id="box1"></div>
                    <!-- om man äger spellistan kan man radera den -->
                    @if(Auth::check())
                    @if(Auth::user()->userID == $user->userID )
                    {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID1))) !!}
                    {!! csrf_field() !!}
                    {!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort spellistan?");' )) !!}
                    {!! Form::close() !!}
                    @endif
                    @endif
                    <script>
                      $('#play').submit(function(e){
                      e.preventDefault();
                      $("#box1").load( "http://localhost/Herz/public/player.html" );
                      $('#closePlayer').removeClass("hidden");
                      $('#play').addClass("hidden");
                      var listID = $('#listID').val();
                      var listID = $.trim(listID);
                      var userID = $('#userID').val();
                      var userID = $.trim(userID); 
                      $.ajax({
                      url: 'http://localhost/Herz/public/list.php',
                      data: { listID: listID, userID: userID},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>
                  </div>
                  <!-- slut första result-->
                  @endif
                  @if($count > 1)
                  <div role="tabpanel" class="tab-pane" id="{{ $list2->listTitle }}">
                    <h2><a href="http://localhost/Herz/public/playlist/{{ $list2->listID }}">{{ $list2->listTitle }}</a></h2>
                    <br>
                    <h4>Beskrivning</h4>
                    <br>
                    <p>{{ $list2->listDescription }}</p>
                    <form action="" method="put" name="play2" id="play2">
                      <input type="hidden" name="listID2" value="{{ $list2->listID }}" id="listID2">
                      <button type="submit" class="btn btn-default btn-lg" id="play2">
                        <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                      </button>
                    </form>  
                    <div id="box2"></div>
                    <!-- om man äger spellistan kan man radera den -->
                    @if(Auth::check())
                    @if(Auth::user()->userID == $user->userID )
                    {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID2))) !!}
                    {!! csrf_field() !!}
                    {!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort spellistan?");' )) !!}
                    {!! Form::close() !!}
                    @endif
                    @endif
                    <script>
                      $('#play2').submit(function(e){
                      e.preventDefault();
                      $("#box2").load( "http://localhost/Herz/public/player.html" );
                      var listID2 = $('#listID2').val();
                      var listID2 = $.trim(listID2);
                      var userID2 = $('#userID2').val();
                      var userID2 = $.trim(userID2); 
                      $.ajax({
                      url: 'http://localhost/Herz/public/list2.php',
                      data: { listID2: listID2, userID2: userID2},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>                    
                  </div>
                    @endif
                    @if($count > 2)
                  <div role="tabpanel" class="tab-pane" id="{{ $list3->listTitle }}">
                    <h2><a href="http://localhost/Herz/public/playlist/{{ $list3->listID }}">{{ $list3->listTitle }}</a></h2>
                    <br>
                    <h4>Beskrivning</h4>
                    <br>
                    <p>{{ $list2->listDescription }}</p>
                    <form action="" method="put" name="play3" id="play3">
                      <input type="hidden" name="listID3" value="{{ $list3->listID }}" id="listID3">
                      <button type="submit" class="btn btn-default btn-lg" id="play3">
                        <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                      </button>
                    </form>  
                    <div id="box3"></div>
                    <!-- om man äger spellistan kan man radera den -->
                    @if(Auth::check())
                    @if(Auth::user()->userID == $user->userID )
                    {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID3))) !!}
                    {!! csrf_field() !!}
                    {!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort spellistan?");' )) !!}
                    {!! Form::close() !!}
                    @endif
                    @endif
                    <script>
                      $('#play3').submit(function(e){
                      e.preventDefault();
                      $("#box3").load( "http://localhost/Herz/public/player.html" );
                      var listID3 = $('#listID3').val();
                      var listID3 = $.trim(listID3);
                      var userID3 = $('#userID3').val();
                      var userID3 = $.trim(userID3); 
                      $.ajax({
                      url: 'http://localhost/Herz/public/list3.php',
                      data: { listID3: listID3, userID3: userID3},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>                    
                  </div>
                    @endif
                    @if($count > 3)
                  <div role="tabpanel" class="tab-pane" id="{{ $list4->listTitle }}">
                    <h2><a href="http://localhost/Herz/public/playlist/{{ $list4->listID }}">{{ $list4->listTitle }}</a></h2>
                    <br>
                    <h4>Beskrivning</h4>
                    <br>
                    <p>{{ $list4->listDescription }}</p>
                    <form action="" method="put" name="play4" id="play4">
                      <input type="hidden" name="listID4" value="{{ $list4->listID }}" id="listID4">
                      <button type="submit" class="btn btn-default btn-lg" id="play4">
                        <span class="glyphicon glyphicon-expand" aria-hidden="true"></span>
                      </button>
                    </form>  
                    <div id="box4"></div>
                    <!-- om man äger spellistan kan man radera den -->
                    @if(Auth::check())
                    @if(Auth::user()->userID == $user->userID )
                    {!!   Form::open(array('method' => 'DELETE', 'route' => array('playlist.destroy', $listID4))) !!}
                    {!! csrf_field() !!}
                    {!! Form::submit('X', array('class' => 'btn btn-danger', 'onclick' => 'return confirm("Säker på att du vill ta bort spellistan?");' )) !!}
                    {!! Form::close() !!}
                    @endif
                    @endif
                    <script>
                      $('#play4').submit(function(e){
                      e.preventDefault();
                      $("#box4").load( "http://localhost/Herz/public/player.html" );
                      var listID4 = $('#listID4').val();
                      var listID4 = $.trim(listID4);
                      var userID4 = $('#userID4').val();
                      var userID4 = $.trim(userID4); 
                      $.ajax({
                      url: 'http://localhost/Herz/public/list4.php',
                      data: { listID4: listID4, userID4: userID4},
                      dataType: 'json',
                      success: function(data){            
                      }
                      });
                      });
                    </script>                    
                  </div>
                    @endif
                    @endif