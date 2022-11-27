<div class="modal-body p-4 c-scrollbar-light">
	
    <div class="row">
        <div class="col-12">
            @if($order->communication_status==null && $order->communication_note==null )
            <div class="text-center">
                <h3 class="mb-4 fs-20 fw-600 opacity-60 mx-auto">No Note available! Please Add note.</h3>
            </div>
            @endif
            <h3 class="mb-2 fs-18 fw-600"> Order code: {{$order->code}}</h3>
@if($order->communication_status==null && $order->communication_note==null )
            

            <form id="addnote" class="form-default" action="{{ route('note.store') }}" method="get">

                <div class="form-group input-group">
                    <input type="hidden" class="form-control" value="{{$order->id}}" name="id">
                </div>
            
                <div class="form-group input-group">
                    <label class="fw-500 fs-14 w-100">Status:</label>
                    <select class="form-control rit-selectpicker" name="communication_status" id="status">
                        <option value="" >Select Status</option>

                        <option value="no_answer" @if ($order->communication_status == 'no_answer') selected @endif>No Answer</option>
                        <option value="product_not_available" @if ($order->communication_status == 'product_not_available') selected @endif>Prodcut Not available</option>
                        <option value="schedule_for_later" @if ($order->communication_status == 'schedule_for_later') selected @endif>Schedule For later</option>
                        <option value="others" @if ($order->communication_status == 'others') selected @endif>Others</option>

                    </select>
                </div>
            
                <div class="form-group input-group">
                    <label class="fw-500 fs-14 w-100">Special Note:</label>
                    <textarea class="form-control"  placeholder="Add special note. If any!" name="communication_note"> {{$order->communication_note}} </textarea>  
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-sm btn-success ">Add Note</button>
                </div>
               
            </form>
@else

<form id="addnote" class="form-default" action="{{ route('note.store') }}" method="get">

    <div class="form-group input-group">
        <input type="hidden" class="form-control" value="{{$order->id}}" name="id">
    </div>

    <div class="form-group input-group">
        <label class="fw-500 fs-14 w-100">Status:</label>
        <select class="form-control rit-selectpicker" name="communication_status" id="status" disabled>
            <option >Sellect Status</option>
            <option value="no_answer" @if ($order->communication_status == 'no_answer') selected @endif>No Answer</option>
            <option value="product_not_available" @if ($order->communication_status == 'product_not_available') selected @endif>Prodcut Not available</option>
            <option value="schedule_for_later" @if ($order->communication_status == 'schedule_for_later') selected @endif>Schedule For later</option>
            <option value="others" @if ($order->communication_status == 'others') selected @endif>Others</option>

        </select>
    </div>

    <div class="form-group input-group">
        <label class="fw-500 fs-14 w-100">Special Note:</label>
        <textarea class="form-control"  placeholder="Add special note. If any!" name="communication_note" id="note" disabled> {{$order->communication_note}} </textarea>  
    </div>
    <div class="text-right">
        <span class="btn btn-sm btn-danger mr-2" id="erase" onclick="erasenote()">Erase Note</span> <button type="submit" class="btn btn-sm btn-success d-none" id="update" >Update Note</button><span class="btn btn-sm btn-primary" id="edit" onclick="editnote()">Edit Note</span>
    </div>
</form>

@endif
     
    </div>
</div>
</div>
<script>
function editnote(){
    $('#status').prop('disabled', false);
    $('#note').prop('disabled', false);
    $('#update').removeClass('d-none');
    $('#edit').addClass('d-none');
    $('#status').focus();
};

function erasenote(){
    $('#addnote').find("textarea,select").val("");
    $('#addnote').submit();
}

</script>
