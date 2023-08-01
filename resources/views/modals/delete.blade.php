<div class="modal fade" id="delete{{ $content->id }}" tabindex="-1" aria-labelledby="deleteLabel{{ $content->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteLabel{{ $content->id }}">「{{ $content->title }}」を削除しますか？</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <form action="{{ route('contents.destroy', $content) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>
