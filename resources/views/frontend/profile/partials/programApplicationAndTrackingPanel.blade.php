<div class="card">
    <div class="card-body">
        <table>
            <tbody>
            <tr>
                <td> İlkin seçim:</td>
                <td>
                    @if($last_application -> applicationStage -> stage -> Id == 1 && $last_application -> applicationStage -> stageResult  -> Id == 2)
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm "
                                                             style="color: yellow; font-size:24px"
                                                             aria-hidden="true"></i>
                            @endif
                            @if($last_application -> applicationStage -> stage -> Id == 1 && $last_application -> applicationStage -> stageResult  -> Id == 3)
                                <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm"
                                                                  style="color: red; font-size:24px"
                                                                  aria-hidden="true"></i></a>
                            @endif
                            @if(($last_application -> applicationStage -> stage  -> Id == 1 && $last_application -> applicationStage -> stageResult  -> Id == 1) || $last_application -> applicationStage -> stage  -> Id == 2 || $last_application -> applicationStage -> stage  -> Id == 3 || $last_application -> applicationStage -> stage  -> Id == 4   )
                                <a href="#" title="Seçildi"><i class="fa fa-circle fa-sm"
                                                               style="color: green; font-size:24px"
                                                               aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>


            <tr>
                <td>Müsahibə:</td>
                <td>
                    @if( ($last_application -> applicationStage -> stage -> Id == 1 &&  $last_application -> applicationStage -> stageResult  -> Id == 1) || ($last_application -> applicationStage -> stage -> Id == 2 &&  $last_application -> applicationStage -> stageResult  -> Id == 2))
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm"
                                                             style="color: yellow; font-size:24px"
                                                             aria-hidden="true"></i></a>
                    @endif
                    @if($last_application -> applicationStage -> stage -> Id == 2 &&  $last_application -> applicationStage -> stageResult  -> Id == 3)
                        <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px"
                                                          aria-hidden="true"></i></a>
                    @endif
                    @if ( ($last_application -> applicationStage -> stage  -> Id == 2 && $last_application -> applicationStage -> stageResult  -> Id == 1) || $last_application -> applicationStage -> stage  -> Id == 3 || $last_application -> applicationStage -> stage  -> Id == 4 )
                        <a href="#" title="Seçildi"> <i class="fa fa-circle fa-sm" style="color: green; font-size:24px"
                                                        aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Komissiya:</td>
                <td>
                    @if(($last_application -> applicationStage -> stage -> Id == 2 &&  $last_application -> applicationStage -> stageResult  -> Id == 1) || ($last_application -> applicationStage -> stage -> Id == 3 &&  $last_application -> applicationStage -> stageResult  -> Id == 2))
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm"
                                                             style="color: yellow; font-size:24px"
                                                             aria-hidden="true"></i></a>
                    @endif
                    @if($last_application -> applicationStage -> stage -> Id == 3 &&  $last_application -> applicationStage -> stageResult  -> Id == 3)
                        <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px"
                                                          aria-hidden="true"></i></a>
                    @endif
                    @if( ($last_application -> applicationStage -> stage  -> Id == 3 && $last_application -> applicationStage -> stageResult  -> Id == 1) || $last_application -> applicationStage -> stage  -> Id == 4 )
                        <a href="#" title="Seçildi"> <i class="fa fa-circle fa-sm" style="color: green; font-size:24px"
                                                        aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>

            <tr>
                <td>Yekun:</td>
                <td>
                    @if(($last_application -> applicationStage -> stage -> Id == 4 &&  $last_application -> applicationStage -> stageResult  -> Id == 2) || $last_application -> applicationStage -> stage -> Id == 3 &&  $last_application -> applicationStage -> stageResult  -> Id == 1)
                        <a href="#" title="Baxılmadadır"> <i class="fa fa-circle fa-sm"
                                                             style="color: yellow; font-size:24px"
                                                             aria-hidden="true"></i></a>
                    @endif
                    @if($last_application -> applicationStage -> stage -> Id == 4 &&  $last_application -> applicationStage -> stageResult  -> Id == 3)
                        <a href="#" title="Seçilmədi"> <i class="fa fa-circle fa-sm" style="color: red; font-size:24px"
                                                          aria-hidden="true"></i></a>
                    @endif
                    @if($last_application -> applicationStage -> stage -> Id == 4 &&  $last_application -> applicationStage -> stageResult  -> Id == 1  )
                        <a href="#" title="Seçildi"> <i class="fa fa-circle fa-sm" style="color: green; font-size:24px"
                                                        aria-hidden="true"></i></a>
                    @endif
                </td>
            </tr>

            </tbody>
        </table>

        @if($last_application ->  applicationStage -> stage )
            <div class="alert alert-success" role="alert">
                @if($last_application -> applicationStage -> stageResult  -> Id == 3)
                    <span style="font-weight: bold">Cari status:</span> {{$last_application -> applicationStage -> stage -> Name ." mərhələsindən keçə bilmədi"}}
                @elseif(($last_application -> applicationStage -> stage  -> Id == 1 && $last_application -> applicationStage -> stageResult  -> Id == 2) )
                    <span style="font-weight: bold">Cari status:</span> İlkin seçim mərhələsindədir
                @elseif(($last_application -> applicationStage -> stage  -> Id == 1 && $last_application -> applicationStage -> stageResult  -> Id == 1) || ($last_application -> applicationStage -> stage  -> Id == 2 && $last_application -> applicationStage -> stageResult  -> Id == 2))
                    <span style="font-weight: bold">Cari status:</span> Müsahibə mərhələsindədir <br><span style="font-weight: bold">Müsahibə vaxtı:</span> {{ date('d-m-Y H:i', strtotime($last_application -> InterviewDate))}}
                @elseif(($last_application -> applicationStage -> stage  -> Id == 2 && $last_application -> applicationStage -> stageResult  -> Id == 1) || ($last_application -> applicationStage -> stage  -> Id == 3 && $last_application -> applicationStage -> stageResult  -> Id == 2))
                    <span style="font-weight: bold">Cari status:</span> Komissiya mərhələsindədir
                @elseif(($last_application -> applicationStage -> stage  -> Id == 3 && $last_application -> applicationStage -> stageResult  -> Id == 1) || ($last_application -> applicationStage -> stage  -> Id == 4 && $last_application -> applicationStage -> stageResult  -> Id == 2))
                    <span style="font-weight: bold">Cari status:</span> Yekun mərhələsindədir
                @elseif($last_application -> applicationStage -> stage  -> Id == 4 && $last_application -> applicationStage -> stageResult  -> Id == 1)
                    <span style="font-weight: bold">Cari status:</span>Sonuncu təqaüdü qazandı
                @endif
            </div>
        @endif

        @if(!$last_application -> applicationStageNotes -> isEmpty() && $last_application -> applicationStageNotes -> last() ->sending ==1)
            <div class="alert alert-warning" role="alert">
                <span style="font-weight: bold">Qeyd:</span> {{ $last_application -> applicationStageNotes -> last() -> Note }}
            </div>
        @endif

        {{$last_application -> applicationStageNotes -> last()}}

    </div>

</div>
<hr>