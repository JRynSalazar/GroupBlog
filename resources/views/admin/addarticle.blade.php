
<div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-between">
        <h3 class="display-5" id="page1">
            <span class="fw-bold text-danger">N</span>ews And <span class="fw-bold text-danger">R</span>esources
        </h3>
    </div>
</div>
@if ($latestMedia)  
<div class="card my-4">
    <div class="row g-0 align-items-center">

        <div class="col-md-5 col-12 text-center">
            <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal" 
               onclick="changeMedia('{{ asset('storage/' . $latestMedia->file_path) }}', '{{ $latestMedia->file_type }}')">
                @if ($latestMedia->file_type === 'video')
                    <video class="rounded media-content m-3" controls style="max-width: 100%; height: auto;">
                        <source src="{{ asset('storage/' . $latestMedia->file_path) }}" type="video/mp4">
                    </video>
                @elseif ($latestMedia->file_type === 'image')
                    <img src="{{ asset('storage/' . $latestMedia->file_path) }}" class="img-fluid rounded media-content mb-3 ms-3 mt-3" style="max-width: 100%; height: auto;">
                @else
                    <a href="{{ asset('storage/' . $latestMedia->file_path) }}" target="_blank" class="btn btn-primary mb-3 ms-3 mt-3">Download File</a>
                @endif
            </a>
        </div>
        {{-- <div class="col-md-1 p-3"></div> --}}
 
        <div class="col-md-7 col-12 p-3">
            <div class="ms-3">
            <h4><b>{{ $latestMedia->title }}</b></h4>
            <p>{{ $latestMedia->description }}</p>
            <small class="text-muted">Uploaded: {{ $latestMedia->created_at->diffForHumans() }}</small>
        </div>
        </div>
    </div>
</div>

<style>
    .media-content {
        width: 100%;
        max-width: 400px; 
        height: auto;
    }
</style>

@endif

<div class="container mt-3">
    <h6><b>More News and Resources</b></h6>
    <div class="d-flex overflow-auto p-2 gap-3">
        @foreach ($moreMedia as $item)
        <div class="card shadow-lg rounded-4 overflow-hidden border-0 m-2" style="width: 220px; flex: 0 0 auto;">

            <a href="#" data-bs-toggle="modal" data-bs-target="#mediaModal" 
               class="position-relative text-decoration-none"
               onclick="changeMedia(`{{ asset('storage/' . $item->file_path) }}`, `{{ $item->file_type }}`, `{{ $item->title }}`, `{{ $item->description }}`)">
               
                <div class="media-container position-relative">
                    @switch($item->file_type)
                        @case('video')
                            <video class="w-100 rounded-top" style="object-fit: cover; height: 140px;" muted>
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                            </video>
                            <div class="play-overlay position-absolute top-50 start-50 translate-middle bg-dark bg-opacity-50 rounded-circle p-2">
                                <i class="fas fa-play text-white"></i>
                            </div>
                            @break

                        @case('image')
                            <img src="{{ asset('storage/' . $item->file_path) }}" class="img-fluid rounded-top" style="height: 140px; object-fit: cover;" alt="{{ $item->title }}">
                            @break

                        @default
                            <div class="d-flex justify-content-center align-items-center bg-light text-center" style="height: 140px;">
                                <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">View File</a>
                            </div>
                            
                    @endswitch

                </div>
            </a>
        
            <div class="card-body p-3">
                <h6 class="card-title text-truncate"><b>{{ $item->title }}</b></h6>
                <p class="card-text small text-muted text-truncate" style="max-width: 180px;">{{ $item->description }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="d-flex justify-content-center my-4">
    <a href="{{ route('blog.news') }}" class="btn btn-danger btn-lg">View All</a>
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

<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaTitle">Media Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="modalContent"></div>
                <p class="mt-3" id="mediaDescription"></p>
            </div>
        </div>
    </div>
</div>


<script>
     function changeMedia(filePath, type, title, description) {
        let modalTitle = document.getElementById("mediaTitle");
        let modalDescription = document.getElementById("mediaDescription");
        let modalContent = document.getElementById("modalContent");

        modalTitle.textContent = title; 
        modalDescription.textContent = description; 

        if (type === "video") {
            modalContent.innerHTML = `<video width="100%" height="auto" controls>
                                        <source src="${filePath}" type="video/mp4">
                                        Your browser does not support the video tag.
                                      </video>`;
        } else if (type === "image") {
            modalContent.innerHTML = `<img src="${filePath}" alt="Media" class="img-fluid">`;
        } else {
            modalContent.innerHTML = `<a href="${filePath}" target="_blank" class="btn btn-primary">View/Download File</a>`;
        }
    }

    function changeVideo(videoSrc) {
        var video = document.getElementById('modalVideo');
        video.src = videoSrc;
        video.load();
        video.play();
    }

    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        var video = document.getElementById('modalVideo');
        video.pause();
        video.currentTime = 0;
    });

</script>

