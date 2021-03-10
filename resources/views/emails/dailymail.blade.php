<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<table >
    <tr>
        
        <th>title</th>
        <th>domain</th>
        <th>email</th>
        <th>phone number</th>
        <th>description</th>
        <th>country</th>
    </tr>
    
@foreach($leads as $lead)
    <tr>
        <td> {{ $lead->title }}</td>
        <td> {{ $lead->email }}</td>
        <td> {{ $lead->category ? $lead->category->title : 'not-available' }}</td>
        <td> {{ $lead->phone_num }}</td>
        <td> {{ $lead->description }}</td>
        <td> {{ $lead->country }}</td>
    </tr>
@endforeach
</table>

</body>
</html>