@extends('layouts.master')

@section('addCSS')
<link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('sufee-admin-dashboard-master/assets/css/lib/chosen/chosen.min.css') }}">
<style>
  .table td {
    font-size: 14px;
  }

  .table th {
    font-size: 12px;
  }

  .modal-dialog {
    overflow-y: initial !important
  }

  .custom {
  height: 90vh;
  overflow-y: auto;
  }  

  .spinner {
  opacity: 100%;  
  width: 100px;  
  position: fixed;
  z-index: 1;
  top: 40%;
  left: 50%;
  margin-left: -2em;
}
</style>
@endsection


@section('content-title')
Documents
@endsection
@section('content')

<div class = "card-body">
<table id="bootstrap-data-table" class="table table-striped table-hover" style="background-color: #FFF;width: 100%; ">
  <thead class="thead-light">
    <tr>
      <th style="width: 10%">File Name</th>
      <th style="width: 10%">Source</th>
    </tr>
  </thead>
  <tr>
      <td><a href="https://www.coa.gov.ph/wp-admin/admin-ajax.php?juwpfisadmin=false&action=wpfd&task=file.download&wpfd_category_id=5144&wpfd_file_id=68470&token=f786a2e47f5b1e93ee06b53696433164&preview=1" target="_blank">COA Circular No. 2022-004 - May 31, 2022 - Annexes A.1 - A.10</a></td>
      <td><a href="https://www.coa.gov.ph/" target="_blank">Commission on Audit Website</a></td>
  </tr>
  <tr>
    <td><a href="https://www.coa.gov.ph/wp-admin/admin-ajax.php?juwpfisadmin=false&action=wpfd&task=file.download&wpfd_category_id=5144&wpfd_file_id=68471&token=f786a2e47f5b1e93ee06b53696433164&preview=1" target="_blank">COA Circular No. 2022-004 - May 31, 2022 - Annex B</a></td>
    <td><a href="https://www.coa.gov.ph/" target="_blank">Commission on Audit Website</a></td>
  </tr>
  <tr>
    <td><a href="http://dtracks/dts/fileuploaded/$2y$10$jTe/joKJxKYHcgHxtjIJ7e1fsQrfBGtH.JLVBhE3Ivjw2eVb91lNm.pdf" target="_blank">Administrative Order No. 228-A - August 15, 2022 - Implementing Guidelines on the Increase in the Capitalization Threshold</a></td>
    <td><a href="https:/dtracks/dts" target="_blank">DocTracks</a></td>
  </tr>
  <tr>
    <td><a href="https://docs.google.com/document/d/1aX20Po1P0TSGPyFUaVD1Aee7sMVpOlawu5etukM5yGg/edit" target="_blank">List of Property Management System Reports Based on COA Circular No. 2022-004</a></td>
    <td></td>
  </tr>
  
  
  <tbody>
    <!-- <tr id="toclear" style=""><td colspan="14"><center><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></center></td></tr> -->
  </tbody>
</table>
</div>

<script src="{{ asset('sufee-admin-dashboard-master/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('js/datetime-moment.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="{{ asset('sufee-admin-dashboard-master/assets/js/lib/chosen/chosen.jquery.min.js') }}"></script>


@endsection
