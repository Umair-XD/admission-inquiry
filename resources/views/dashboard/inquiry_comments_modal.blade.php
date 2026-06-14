<div class="modal fade" id="commentsModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-semibold">
                    <i class="fa-solid fa-comments me-2"></i>Comments — {{ $inquiry->name }}
                    <small class="opacity-75 fw-normal ms-1">
                        {{ $inquiry->department?->name }}{{ $inquiry->course ? ' · '.$inquiry->course->name : '' }}
                    </small>
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">

                {{-- Comment thread --}}
                <div id="commentThread" style="max-height:360px; overflow-y:auto;" class="p-3">
                    @forelse($inquiry->comments as $comment)
                        <div class="d-flex gap-2 mb-3">
                            <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                 style="width:34px;height:34px;font-size:.75rem;">
                                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-baseline gap-2">
                                    <span class="fw-semibold small">{{ $comment->user->name }}</span>
                                    <span class="text-muted" style="font-size:.7rem;">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="border rounded p-2 mt-1 bg-light small">{{ $comment->body }}</div>
                            </div>
                        </div>
                    @empty
                        <div id="noComments" class="text-center text-muted py-5">
                            <i class="fa-regular fa-comments fa-2x mb-2 d-block opacity-30"></i>
                            No comments yet. Be the first to add one.
                        </div>
                    @endforelse
                </div>

                {{-- Add comment --}}
                <div class="border-top p-3 bg-light">
                    <form id="commentForm" data-url="{{ route('inquiry.comments.store', $inquiry->id) }}">
                        @csrf
                        <div class="d-flex gap-2 align-items-end">
                            <textarea id="commentBody" name="body" class="form-control form-control-sm" rows="2"
                                      placeholder="Write a comment..." required style="resize:none;"></textarea>
                            <button type="submit" class="btn btn-primary btn-sm px-3" style="height:38px;">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        <div id="commentError" class="text-danger small mt-1" style="display:none;"></div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>
<script>
(function () {
    // Scroll thread to bottom on open
    var $thread = $('#commentThread');
    $thread.scrollTop($thread[0].scrollHeight);

    // AJAX comment submission
    $('#commentForm').on('submit', function (e) {
        e.preventDefault();
        var $btn      = $(this).find('button[type=submit]');
        var $textarea = $('#commentBody');
        var body      = $textarea.val().trim();
        if (!body) return;

        $btn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin"></i>');
        $('#commentError').hide();

        $.ajax({
            url: $(this).data('url'),
            method: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                $('#noComments').remove();
                var html = '<div class="d-flex gap-2 mb-3">'
                    + '<div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:34px;height:34px;font-size:.75rem;">' + res.initial + '</div>'
                    + '<div class="flex-grow-1">'
                    + '<div class="d-flex align-items-baseline gap-2">'
                    + '<span class="fw-semibold small">' + res.name + '</span>'
                    + '<span class="text-muted" style="font-size:.7rem;">just now</span>'
                    + '</div>'
                    + '<div class="border rounded p-2 mt-1 bg-light small">' + res.body + '</div>'
                    + '</div></div>';
                $thread.append(html).scrollTop($thread[0].scrollHeight);
                $textarea.val('');
            },
            error: function (xhr) {
                var msg = xhr.responseJSON?.message ?? 'Failed to post comment.';
                $('#commentError').text(msg).show();
            },
            complete: function () {
                $btn.prop('disabled', false).html('<i class="fa-solid fa-paper-plane"></i>');
            }
        });
    });
})();
</script>
