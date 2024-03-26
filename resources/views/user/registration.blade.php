<form action="{{ route('user.insertRegistration') }}" method="POST" class="formLogin">
    @csrf
    <label for="dni" class="labelLogin">DNI</label>
    <input type="text" id="dni" name="dni" class="inputLogin" placeholder="Type your DNI" required><br>
    <label for="name" class="labelLogin">Name</label>
    <input type="text" id="name" name="name" class="inputLogin" placeholder="Type your name" required><br>
    <label for="surname" class="labelLogin">Surname</label>
    <input type="text" id="surname" name="surname" class="inputLogin" placeholder="Type your surname" required><br>
    <label for="address" class="labelLogin">Address</label>
    <input type="text" id="address" name="address" class="inputLogin" placeholder="Type your address" required><br>
    <label for="birth" class="labelLogin">Date of birth</label>
    <input type="date" id="birth" name="birth" class="inputLogin" required><br>
    <label for="PRO_OPEN" class="labelLogin">What are you?</label>
    <select id="PRO_OPEN" name="PRO_OPEN" class="inputLogin" required>
        <option value="OPEN">OPEN</option>
        <option value="PRO">PRO</option>
    </select><br>
    <div id="federationInput" style="display: none;">
        <label for="federation" class="labelLogin">Federation number</label>
        <input type="text" id="federation" name="federation" class="inputLogin" placeholder="Type your federation number"><br>
    </div>
    <label for="password" class="labelLogin">Password</label>
    <input type="password" id="password" name="password" class="inputLogin" placeholder="Type your password" required><br>
    <input type="submit" value="Register" class="btn btn-pink btnAdd btnLogin">
</form>
<script src="{{ asset('assets/js/federation.js') }}"></script>