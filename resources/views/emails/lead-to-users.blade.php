<h2>New Lead in Your Category</h2>
<p><strong>Name:</strong> {{ $lead->lead_name }}</p>
<p><strong>Email:</strong> {{ $lead->lead_email }}</p>
<p><strong>Phone:</strong> {{ $lead->lead_phone }}</p>
<p><strong>Notes:</strong> {{ $lead->lead_notes }}</p>
<p><strong>Category:</strong> {{ $lead->category->name ?? 'N/A' }}</p>
