<form action="{{ route('import.results') }}" method="post" enctype="multipart/form-data">
  @csrf 
  <input type="file" name="file" accept=".xlsx, xls"/>
  <button type="submit" name="Import">Import Results</button>
</form>