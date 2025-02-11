<h2 class="subtitle">Assets:</h2>

@if(count($assets))
<table class="table is-striped is-overflow-x-scroll">
	<thead>
		<tr>
			<th class="asset-user-name">Freelancer</th>
			<th class="asset-name">Asset Name</th>
			<th class="asset-link">Link</th>
			<th class="asset-password">Password</th>
		</tr>
	</thead>
	<tbody>
		@foreach($assets as $asset)
		<tr>
			<td class="asset-user-name">
				{{-- <a href="/users/{{ $asset->user->id }}"> --}}
					{{ $asset->user->name }}
				{{-- </a> --}}
			</td>
			<td class="asset-name">{{ $asset->name }}</td>
			<td class="asset-link">
				<a href="{{ $asset->link }}" target="_blank">
					{{ $asset->link }}
				</a>
			</td>
			<td class="asset-password">{{ $asset->password }}</td>
		</tr>
		@endforeach
	</tbody>
</table>
@else

<p>No assets found.</p>

@endif
