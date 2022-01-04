@if (count($errors) > 0)
<div>
  <div class="font-medium text-red-600">
    {{ __('エラー! 再トライしてください') }}
  </div>

  <ul class="mt-3 list-disc list-inside text-sm text-red-600">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif