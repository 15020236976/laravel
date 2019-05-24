  <table>
        
        <tr style=color:red>
            <th>用户评论</th>
        </tr>
     
        @foreach($data as $v)

        <tr>
            <td>{{$v->username}}&nbsp;&nbsp;&nbsp;&nbsp;{{$v->rank}}星</td>
        </tr>
        <tr>
            <td>{{$v->content}}</td>

        </tr>
        <tr>
            <td align=right>{{$v->created_at}}</td>
        </tr>
        <tr>
           <td><hr></td>
        </tr>
        @endforeach
       

    </table>
  {{$data->links()}}