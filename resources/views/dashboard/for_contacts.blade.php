<div class="input-group mb-3">
    <select class="form-control customer-contacts customer_contact_val">
        @foreach($customerContacts as $contact)
        <option value="{{ $contact->ContactID }}">{{ $contact->ContactName }}</value>
        @endforeach
    </select>
        <div class="input-group-append">
            <span style="cursor: pointer;" onclick="openAddContacts(this)" class="input-group-text cContacts"><i class="fas fa-address-book"></i></span>
            <span id="customer-name-text" class="data-text"></span>
        </div>
    </div>
</div>

