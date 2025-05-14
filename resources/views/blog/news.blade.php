@extends('mainapp')
@section('title', 'News and Resources')

@section('navtitle', 'News and Resources')

@section('body')
<div class="container">
    <h3>Media Library</h3>
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    @auth
    @if(auth()->user()->user_type === 'admin')
    <button class="btn btn-danger btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#uploadMediaModal">
        <small>+ Add New Media</small>
    </button>   
    @endif
@endauth
    <div class="row">
        @foreach ($media as $item)
        <div class="card mt-3 p-3 shadow-sm border-5 rounded overflow-hidden" style="width: 200px; flex: 0 0 auto;">
            <a href="#" data-bs-toggle="modal" data-bs-target="#viewMediaModal"
            onclick="openMediaModal('{{ asset('storage/' . $item->file_path) }}', '{{ $item->file_type }}', `{{ $item->title }}`, `{{ $item->description }}`)">

                <div class="media-container position-relative bg-dark">
                    @if ($item->file_type === 'video')
                        <video class="w-100 object-fit-cover" style="height: 130px;" muted>
                            <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                        </video>
                        <div class="play-overlay position-absolute top-50 start-50 translate-middle">
                            <i class="fas fa-play text-white fs-4"></i>
                        </div>
                    @elseif ($item->file_type === 'image')
                        <img src="{{ asset('storage/' . $item->file_path) }}" class="w-100 object-fit-cover" style="height: 130px;" alt="{{ $item->title }}">
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-light text-center" style="height: 130px;">
                            <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">View File</a>
                        </div>
                    @endif
                </div>
            </a>
        
            <div class="card-body text-center p-2">
                <h6 class="card-title text-truncate mb-1"><b>{{ $item->title }}</b></h6>
                <p class="card-text small text-muted text-truncate" style="max-width: 180px;">{{ $item->description }}</p>

                @auth
                @if(auth()->user()->user_type === 'admin')
                    <button class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#editMediaModal"
                        onclick="openEditModal('{{ $item->id }}', `{{ $item->title }}`, `{{ $item->description }}`)">
                        Edit
                    </button>
                    <form action="{{ url('media/' . $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this media?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm mt-2">Delete</button>
                    </form>
                @endif
                @endauth
                
            </div>
        </div>        
        @endforeach
    </div>
</div>

<div class="modal fade" id="viewMediaModal" tabindex="-1" aria-labelledby="viewMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="mediaContent"></div>
                <p class="mt-3" id="mediaDescription"></p>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="uploadMediaModal" tabindex="-1" aria-labelledby="uploadMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            

            <div class="modal-body">
                <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload File (MP4, JPG, PNG, PDF, DOCX)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editMediaModal" tabindex="-1" aria-labelledby="editMediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Media</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editMediaForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" id="editMediaTitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="editMediaDescription" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>

    function openEditModal(id, title, description) {
        document.getElementById('editMediaTitle').value = title;
        document.getElementById('editMediaDescription').value = description;
        document.getElementById('editMediaForm').action = '/media/' + id; // Set the form action dynamically
    }


   function openMediaModal(filePath, fileType, title, description) {
        document.getElementById('mediaTitle').innerText = title;
        document.getElementById('mediaDescription').innerText = description;

        let mediaContent = document.getElementById('mediaContent');
        mediaContent.innerHTML = '';

        if (fileType === 'video') {
            mediaContent.innerHTML = `
                <video width="100%" height="auto" controls>
                    <source src="${filePath}" type="video/mp4">
                </video>
            `;
        } else if (fileType === 'image') {
            mediaContent.innerHTML = `<img src="${filePath}" class="img-fluid">`;
        } else {
            mediaContent.innerHTML = `<a href="${filePath}" target="_blank" class="btn btn-primary">Download File</a>`;
        }
    }
</script>

@endsection