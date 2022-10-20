@if(Auth::user()->user_type == 1)
    @foreach ($post_disable as $disable)
        @if ($disable->post_check->description_check == null)
            <li class="nav-item">
                <a href="{{ route('posts.check', ['id'=>$disable->id]) }}" class="dropdown-item">
                    <span class="image"><img src="{{ $disable->feature_image_path}}" /></span>
                    <span>
                        <span>{{ $disable->post_user->name }}</span>
                        <span class="time">{{ date('d-m-Y', strtotime($disable->created_at)) }}</span>
                    </span>
                    <span class="message">
                        {{ $disable->title }}
                    </span>
                </a>
            </li>
        @endif
    @endforeach
@else
    @foreach ($checked_posts as $checked)
        @if ($checked->post_check->description_check != null)
            <li class="nav-item">
                <a href="{{ route('posts.check', ['id'=>$checked->id]) }}" class="dropdown-item">
                    <span class="image"><img src="{{ $checked->feature_image_path}}" /></span>
                    <span>
                        <b><span>{{ $checked->title}}</span></b>
                        {{-- <span class="time">{{ date('d-m-Y', strtotime($checked->created_at)) }}</span> --}}
                    </span>
                    
                        <span class="message">
                            Notification disable: <b class='text-primary'>{{ $checked->post_check->description_check }}</b>
                        </span>
                    
                    
                </a>
            </li>
        @endif
    @endforeach
@endif