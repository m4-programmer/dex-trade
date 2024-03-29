
@extends(template().'layout.master2')

@section('content2')
    <div class="dashboard-body-part">
        <div class="row">
            <div class="col-md-8 text-md-start text-center">
                <div class="d-flex align-items-center">
                    <h4>{{ $ticket->support_id }} - {{ $ticket->subject }} </h4>

                </div>
            </div>
            <div class="col-md-4  text-md-end text-center">
                <a href="{{ route('ticket.index') }}" class="color-change"><i class="fas fa-arrow-left"></i> {{ translate('Back to Ticket List') }}</a>
            </div>
        </div>

        <div class="mt-4">
            <form action="{{ route('ticket.reply', $ticket->id) }}" enctype="multipart/form-data"
                method="post">
                @csrf
                <div class="row justify-content-md-between">
                    <div class="col-md-12">
                        <div class="form-group ticket-comment-box">
                            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                            <label for="exampleFormControlTextarea1">{{ translate('Message') }}</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                name="message"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 form-group mt-3">
                        <div id="image-preview" class="image-preview">
                            <label for="image-upload" id="image-label">{{ translate('Choose File') }}</label>
                            <input type="file" name="file" id="image-upload" class="form-control" />
                        </div>
                    </div>

                    <div class="col-lg-12 mt-3 text-end">
                            <button type="submit" class="cmn-btn ticket-reply"><i
                                    class="fas fa-reply"></i>
                                {{ translate('Reply') }}
                            </button>
                    </div>
                </div>
            </form>

            <div class="ticket-reply-area mt-5">
                @forelse(@$ticket_reply as $ticket)
                    <div class="single-reply {{$ticket->admin_id != null ? 'admin-reply' : ''}}">
                        <span class="text-small text-secondary mb-2">{{ 'Reply In' }} {{ $ticket->created_at->format('Y-m-d H:i:s') }}</span>
                        <p>
                            {{ $ticket->message }}
                        </p>
                        @if ($ticket->file)
                            <p class="mb-0 mt-2">
                                <a class="color-change" href="{{ route('ticket.download', $ticket->id) }}"> <i class="fas fa-cloud-download-alt"></i> {{ translate('View Attachement') }}</a>
                            </p>
                        @endif
                    </div>
                @empty
                @endforelse
            </div>
        </div>
    </div>
@endsection
