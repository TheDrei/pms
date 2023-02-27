<style>
body{
font-size:14px;

}   
</style>


@foreach ($data as $ppe)
<table width="100%">
  <tr>
    <td class="contentDetails">
     <th align="center"> <h3><strong> {{ $ppe->division }} </strong></h3></th>
    </td>
  </tr>
</table>
<br/>


<!-- HEADER -->
 <!-- <small><br/><strong>Department:</strong> Department of Science and Technology (DOST)</small><br/>
 <small><strong>Cluster: </strong><span id="cluster" value="{{ Auth::user()->cluster }}">{{ Auth::user()->cluster }}</span> </small><br/>
 <small><strong>Agency:</strong> Philippine Council for Agriculture, Aquatic and Natural Resources Research and Development of the Department of Science and Technology (PCAARRD)</small><br/>
 <small><strong>Operating Unit:</strong> N/A</small><br/>
 <small style="color:black;"><strong>Organization Code:</strong> 19 011 0000000</small><br/>
 <small style="color:black;"><strong>Report Status:</strong>  {{ $submissions->status }} </small><br/><br/> -->
<!--END HEADER -->
@endforeach

<!-- END SIGNATORIES -->









