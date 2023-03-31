<table class="table-borderless" style="table-layout: fixed;width: 100%">
    @for($inner=$upperIndex;$inner>$upperIndex-5;$inner--)
        <tr>
            @for($counter=$index-1+.2;$counter<$index+.2;$counter=$counter+0.2)
                @php( $innerVal = $inner / 5 )
                <th class="box_th" style="background-color: {{ getColorForRisk($counter * $innerVal) }}">
                    @if(isset($versions) && $versions)
                        @foreach($versions as $versionCounter => $version)

                            @php($found[] = $versionCounter)
                            @if(bccomp($version->consequenceScore, $counter, 3) == 1 || bccomp($version->consequenceScore, $counter, 3) == 0)
                                @if(bccomp($version->consequenceScore, $counter+.2, 3) == -1)
                                    @if(bccomp($innerVal, $version->likeLiHoodScore, 3) == 1 || bccomp($innerVal, $version->likeLiHoodScore, 3) == 0)
                                        @if(bccomp($version->likeLiHoodScore, $innerVal-.2, 3) == 1)
                                            <i
                                                    onmouseover="showRow({{ $version->id }})"
                                                    onmouseout="hideRow({{ $version->id }})"
                                                    style="cursor:pointer"
                                                    class="fas fa-map-marker mr-ds marker_{{ $version->id }}">{{ $versionCounter + 1 }}</i>
                                        @endif
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endif
                </th>
            @endfor
        </tr>
    @endfor
</table>