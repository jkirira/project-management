@extends('app')

@section('content')

    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror


    <login-component></login-component>

@endsection
<script>
    import LoginComponent from "../../js/components/LoginComponent";
    export default {
        components: {LoginComponent}
    }
</script>
