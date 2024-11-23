<ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link active" href="#">Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">About</a>
    </li>
    <li class="nav-item">
      <a class="nav-link">Edit</a>
    </li>
    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger" type="submit">Logout</button>
    </form>
  </ul>