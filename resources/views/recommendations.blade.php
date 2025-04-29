@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Book Recommendations</h2>

        <form method="GET" action="{{ route('recommend') }}" class="mb-4">
            <div class="row">
                <div class="col-md-3">
                    <label for="genre" class="form-label">Genre</label>
                    <select name="genre" id="genre" class="form-select">
                        <option value="">All Genres</option>
                        <option value="fiction" {{ request('genre') == 'fiction' ? 'selected' : '' }}>Fiction</option>
                        <option value="non-fiction" {{ request('genre') == 'non-fiction' ? 'selected' : '' }}>Non-Fiction
                        </option>
                        <option value="science" {{ request('genre') == 'science' ? 'selected' : '' }}>Science</option>
                        <option value="history" {{ request('genre') == 'history' ? 'selected' : '' }}>History</option>
                        <option value="biography" {{ request('genre') == 'biography' ? 'selected' : '' }}>Biography</option>
                        <option value="fantasy" {{ request('genre') == 'fantasy' ? 'selected' : '' }}>Fantasy</option>
                        <option value="romance" {{ request('genre') == 'romance' ? 'selected' : '' }}>Romance</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-select">
                        <option value="">All Types</option>
                        <option value="novel" {{ request('type') == 'novel' ? 'selected' : '' }}>Novel</option>
                        <option value="textbook" {{ request('type') == 'textbook' ? 'selected' : '' }}>Textbook</option>
                        <option value="comic" {{ request('type') == 'comic' ? 'selected' : '' }}>Comic</option>
                        <option value="magazine" {{ request('type') == 'magazine' ? 'selected' : '' }}>Magazine</option>
                        <option value="encyclopedia" {{ request('type') == 'encyclopedia' ? 'selected' : '' }}>Encyclopedia
                        </option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="min_rating" class="form-label">Minimum Rating</label>
                    <input type="number" name="min_rating" id="min_rating" class="form-control" min="0"
                        max="5" step="0.1" value="{{ request('min_rating') }}">
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        @if (!empty($recommendations))
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Genre</th>
                            <th>Type</th>
                            <th>Rating</th>
                            <th>Preference</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recommendations as $rec)
                            <tr>
                                <td>{{ $rec['book']['title'] }}</td>
                                <td>{{ $rec['book']['author'] }}</td>
                                <td>{{ ucfirst($rec['book']['genre']) }}</td>
                                <td>{{ ucfirst($rec['book']['type']) }}</td>
                                <td>{{ number_format($rec['book']['average_rating'], 1) }}</td>
                                <td>
                                    {{ is_numeric($rec['preference']) ? number_format($rec['preference'] * 100, 2) . '%' : 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (count($recommendations) == 0)
                <div class="d-flex flex-column align-items-center justify-content-center my-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="No Books Found" width="150"
                        class="mb-4" style="opacity: 0.7;">
                    <h4 class="text-muted mb-3">No books found matching your criteria.</h4>
                    <a href="{{ route('recommend') }}" class="btn btn-outline-primary">
                        ← Back to Filter
                    </a>
                </div>
            @endif
        @else
            <p>No recommendations available.</p>
        @endif
    </div>
@endsection
