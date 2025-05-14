@isset($post_comments)
    <div class="container mt-4">
        <div class="row">
            @foreach ($post_comments as $post_comment)
                @php
                    $imagePath = $post_comment->image !== asset('images/default.png') ? $post_comment->image : null;
                    $profilePath = $post_comment->user && $post_comment->user->profile_image ? asset('storage/' . $post_comment->user->profile_image) : null;
                    $modalId = 'imageModal' . $post_comment->post_id;
                    $postInputId = 'postInput' . $post_comment->post_id;
                    $dropdownId = 'dropdownMenu' . $post_comment->post_id;
                    $replySectionId = 'replySection' . $post_comment->post_id;
                    Log::info('Rendering post comments view', ['post_comments' => $post_comments]);
                @endphp

                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-0" style="border-radius: 12px; overflow: hidden;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center mb-3">
                                    @if ($profilePath) 
                                        <img src="{{ $profilePath }}" class="rounded-circle me-2" 
                                            style="width: 50px; height: 50px; object-fit: cover;" alt="User Profile">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" class="rounded-circle me-2" 
                                            style="width: 50px; height: 50px; object-fit: cover;" alt="Default Profile">
                                    @endif
                                    <h5 class="mb-0">{{ $post_comment->user->name ?? 'Unknown User' }}</h5> 
                                </div>

                                @if(auth()->check() && auth()->id() === $post_comment->user_id  || auth()->user()->user_type === 'admin')
                                <div class="dropdown">
                                    <button class="btn border-0 p-0" type="button" id="{{ $dropdownId }}" 
                                        data-bs-toggle="dropdown" aria-expanded="false" 
                                        style="background: transparent;">
                                        <img src="{{ asset('images/option.png') }}" alt="Options" 
                                            width="15" height="15" class="img-fluid">
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $dropdownId }}">
                                        <li>
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal{{ $post_comment->post_id }}">
                                                ✏ Edit
                                            </button>
                                        </li>
                                        <li>
                                            <form action="{{ route('post-comment.destroy', $post_comment->post_id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this post?')">
                                                    🗑 Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                               
                            @endif
                            </div>

                            @if ($imagePath)
                                <img src="{{ $imagePath }}" class="img-fluid rounded mb-3" alt="Post Image" 
                                    style="height: 200px; object-fit: cover; cursor: pointer;" 
                                    data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                            @endif

                            <h4 class="fw-bold">{{ $post_comment->title }}</h4>

                            <p class="card-text text-muted">
                                {{ $post_comment->content }}
                            </p>

                            <span class="badge bg-secondary">{{ $post_comment->discriminationType->type }}</span>
                        </div>

                        <div class="card-footer bg-white border-0 d-flex justify-content-between">
                            <button class="btn btn-outline-danger like-btn d-flex align-items-center" data-post-id="{{ $post_comment->post_id }}">
                                <span class="like-icon">
                                    @if($post_comment->isLikedByUser())
                                        💙 Liked
                                    @else
                                        ❤️ Like
                                    @endif
                                </span>
                                <span class="like-count ms-2">{{ $post_comment->likes->count() }}</span>
                            </button>

                            <button class="btn btn-outline-primary d-flex align-items-center comment-btn"
                                    data-input="{{ $postInputId }}" 
                                    data-section="{{ $replySectionId }}">
                                💬 Reply <span class="ms-2 badge bg-secondary">{{ $post_comment->replies->count() }}</span>
                            </button>
                        </div>

                        <div class="p-3 reply-section" id="{{ $replySectionId }}" style="display: none;">

                            <form action="{{ route('post-comment.reply', $post_comment->post_id) }}" method="POST" class="mb-3 d-flex">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post_comment->post_id }}">
                                <input type="text" class="form-control me-2" name="comment" placeholder="Write a reply..." required>
                                <button type="submit" class="btn btn-sm btn-success">Send</button>
                            </form>
                            @foreach ($post_comment->replies as $reply)
                                <div class="d-flex align-items-center mt-2">
                                    <img src="{{ $reply->user->profile_image ? asset('storage/' . $reply->user->profile_image) : asset('images/default.png') }}" 
                                    class="rounded-circle me-2" style="width: 30px; height: 30px;" alt="User Profile">
                                    <p class="mb-0"><strong>{{ $reply->user->name }}</strong>: {{ $reply->comment }}</p>
                                </div>
                            @endforeach
                        </div>



                        <div class="p-3 post-input" id="{{ $postInputId }}" style="display: none;">
                            <input type="text" class="form-control" placeholder="Write a comment..." />
                        </div>
                    </div>
                </div>

                @if ($imagePath)
                    <div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content bg-transparent border-0">
                                <div class="modal-body text-center">
                                    <img src="{{ $imagePath }}" class="img-fluid rounded shadow-lg" alt="Full Image">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="modal fade" id="editModal{{ $post_comment->post_id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg"> 
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Post</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('post-comment.update', $post_comment->post_id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{ $post_comment->title }}" required>
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <textarea class="form-control" id="content" name="content" rows="4" required>{{ $post_comment->content }}</textarea>
                                    </div>
                
                                    <div class="mb-3">
                                        <label class="form-label">Current Image</label>
                                        <div>
                                            @if ($post_comment->image)
                                                <img src="{{ asset($post_comment->image) }}" alt="Current Image" class="img-thumbnail" width="150">
                                            @else
                                                <p class="text-muted">No image uploaded</p>
                                            @endif
                                        </div>
                                        <label for="image" class="form-label mt-2">Upload New Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                
                                    <div class="mb-3">
                                        <label for="discrimination_type" class="form-label">Discrimination Type</label>
                                        <select class="form-select" name="type_id" required> 
                                            <option value="">Select Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}" 
                                                    {{ old('type_id', $post_comment->type_id) == $type->id ? 'selected' : '' }}>
                                                    {{ $type->type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save Changes</button>
                                    </div>
                                </form>

                                

                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function () {
                    let postId = this.getAttribute('data-post-id');
                    let likeIcon = this.querySelector('.like-icon');
                    let likeCount = this.querySelector('.like-count');

                    fetch(`/post-comment/${postId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })

                    .then(response => response.json())
                    .then(data => {
                        likeCount.textContent = data.likes_count;
                        likeIcon.innerHTML = data.liked ? '💙 Liked' : '❤️ Like';
                    });
                });
            });
        });

    
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.comment-btn').forEach(button => {
                button.addEventListener('click', function () {
                    let replySection = document.getElementById(this.getAttribute('data-section'));
                    replySection.style.display = replySection.style.display === 'none' ? 'block' : 'none';
                });
            });
        });
   
    </script>
@else
    <p>No posts available.</p>
@endisset
