<div class="card">
    <div class="card-body">
        <table>
            <tbody>
            <tr>
                <td> İlkin seçim:</td>
                <td>
                    @if($application_stage -> stage -> Id == 1 && $application_stage -> stageResult  -> Id == 2)
                            <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm " style="color: yellow; font-size:24px" aria-hidden="true"></i>
                    @endif
                    @if($application_stage -> stage -> Id == 1 && $application_stage -> stageResult  -> Id == 3)
                            <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if(($application_stage -> stage -> Id == 1 && $application_stage -> stageResult  -> Id == 1) || $application_stage -> stage  -> Id == 2 || $application_stage -> stage  -> Id == 3 || $application_stage -> stage  -> Id == 4   )
                            <a href="#" title="Seçildi"><i class="fa fa-circle fa-sm" style="color: green; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>


            <tr>
                <td>Müsahibə:</td>
                <td>
                    @if($application_stage -> stage -> Id == 2 &&  $application_stage -> stageResult  -> Id == 2)
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm" style="color: yellow; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if($application_stage -> stage -> Id == 2 &&  $application_stage -> stageResult  -> Id == 3)
                        <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if(($application_stage -> stage -> Id == 2 &&  $application_stage -> stageResult  -> Id == 1) || $application_stage -> stage  -> Id == 3 || $application_stage -> stage  -> Id == 4 )
                        <a href="#" title="Seçildi"> <i class="fa fa-circle fa-sm" style="color: green; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Komissiya:</td>
                <td>
                    @if($application_stage -> stage -> Id == 3 &&  $application_stage -> stageResult  -> Id == 2)
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm" style="color: yellow; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if($application_stage -> stage -> Id == 3 &&  $application_stage -> stageResult  -> Id == 3)
                        <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if(($application_stage -> stage -> Id == 3 &&  $application_stage -> stageResult  -> Id == 1) || $application_stage -> stage  -> Id == 4 )
                        <a href="#" title="Seçildi">  <i class="fa fa-circle fa-sm" style="color: green; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Yekun:</td>
                <td>
                    @if($application_stage -> stage -> Id == 4 &&  $application_stage -> stageResult  -> Id == 2)
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm" style="color: yellow; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if($application_stage -> stage -> Id == 4 &&  $application_stage -> stageResult  -> Id == 3)
                        <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                    @if($application_stage -> stage -> Id == 4 &&  $application_stage -> stageResult  -> Id == 1  )
                        <a href="#" title="Seçildi"> <i class="fa fa-circle fa-sm" style="color: green; font-size:24px" aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</div>
<hr>