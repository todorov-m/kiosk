<x-layout>
<div class="row justify-content-center mt-4">
    <div class="card" style="width: 30rem;">
        <a role="button" class="btn btn-success pt-5 pb-5 total-size" href="/newsales" onclick="event.preventDefault();
                                                     document.getElementById('new-sale').submit();">Нова Продажба</a>
        <form id="new-sale" action="/newsales" method="POST"
              style="display: none;">
            <input type="hidden" name="users_id" value="{{auth()->user()->id}}">
            <input type="hidden" name="total" value="0">
            <input type="hidden" name="status" value="0">
            <input type="hidden" name="salesId" value="0">
            @csrf
        </form>

    </div>
</div>
</x-layout>
