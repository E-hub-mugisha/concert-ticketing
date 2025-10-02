@extends('layouts.guest')

@section('content')
<div class="container py-5">
    <h1 class="mb-5 text-center">Upcoming events</h1>

    @if($events && $events->count())
        @foreach($events as $event)
        <div class="card mb-4">
            <div class="card-body">
                <h3>{{ $event->title }}</h3>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($event->event_date)->format('F d, Y H:i') }}</p>
                <p><strong>Venue:</strong> {{ $event->venue }}</p>
                <p>{{ $event->description }}</p>

                @if($event->image)
                    <img src="{{ asset('storage/' . $event->image) }}" class="img-fluid rounded mb-3" style="max-height:250px;">
                @endif

                <h5>Tickets</h5>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($event->tickets as $ticket)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketModal{{ $ticket->id }}">
                            {{ $ticket->name }} - ${{ number_format($ticket->price, 2) }} ({{ $ticket->quantity - $ticket->sold }} left)
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="ticketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="ticketModalLabel{{ $ticket->id }}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="ticketModalLabel{{ $ticket->id }}">Buy {{ $ticket->name }} Ticket</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="{{ route('checkout') }}" method="POST" class="ticket-form">
                                    @csrf
                                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                    <div class="mb-2">
                                        <label>Quantity</label>
                                        <input type="number" name="quantity" class="form-control ticket-quantity" min="1" max="{{ $ticket->quantity - $ticket->sold }}" value="1" required>
                                    </div>

                                    <div class="attendees-section mb-2"></div>

                                    <h5>Buyer Details</h5>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <input type="text" name="customer_name" class="form-control" placeholder="Full Name" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="email" name="customer_email" class="form-control" placeholder="Email" required>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="customer_phone" class="form-control" placeholder="Phone" required>
                                        </div>
                                    </div>

                                    <h5>Total: $<span class="total-price">{{ number_format($ticket->price, 2) }}</span></h5>
                                    <input type="hidden" name="total_amount" class="total-amount" value="{{ $ticket->price }}">

                                    <button type="submit" class="btn btn-success w-100 mt-2">Proceed to Checkout</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
        @endforeach
    @else
        <p class="text-center">No events available at the moment.</p>
    @endif
</div>

<script>
document.querySelectorAll('.ticket-form').forEach(form => {
    const quantityInput = form.querySelector('.ticket-quantity');
    const attendeesSection = form.querySelector('.attendees-section');
    const totalPriceSpan = form.querySelector('.total-price');
    const totalAmountInput = form.querySelector('.total-amount');
    const ticketPrice = parseFloat(totalAmountInput.value);

    function updateAttendees() {
        const qty = parseInt(quantityInput.value) || 1;
        attendeesSection.innerHTML = '';
        for(let i=1; i<=qty; i++){
            attendeesSection.innerHTML += `<input type="text" name="attendees[]" class="form-control mb-1" placeholder="Attendee ${i} Name" required>`;
        }
        const total = ticketPrice * qty;
        totalPriceSpan.textContent = total.toFixed(2);
        totalAmountInput.value = total.toFixed(2);
    }

    quantityInput.addEventListener('input', updateAttendees);
    updateAttendees();
});
</script>
@endsection
