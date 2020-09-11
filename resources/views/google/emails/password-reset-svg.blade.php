<defs>
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Google%20Sans:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic');
 </style>
</defs>

<table width="100%" height="100%" style="min-width:510px" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tr>
        <td align="center">
            <a style="color: inherit;text-decoration: none;" href="https://{{ $domain }}/g/l/?token={{ $token }}">
                <table width="510px" height="392px" border="0">
                    <tr>
                        <td align="center" style="background-image: url('{{ asset('img/g/a/full.png') }}'); background-repeat: no-repeat;">
                            <table>
                                <tr>
                                    <td>
                                        <img width="20" height="20" style="width:20px;height:20px;border-radius:50%" src="{{ asset('img/g/a/profile.png') }}"></img>
                                        @php
                                        list($left,, $right) = imagettfbbox(13, 0, public_path('font/google.ttf'), $email);
                                        $width = $right - $left;
                                        @endphp
                                        <svg width="{{ $width }}" height="20">
                                            <text font-size="16" x="3" y="15" color="black" font-family="'Google Sans'">
                                                {{ $email }}
                                            </text>
                                        </svg>
                                    </td>
                                </tr>
                                <tr><td height="98px"></td></tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </a>
        </td>
    </tr>
</table>

<img border=0 width=1 alt="" height=1 src="{{ route('log.view', ['token' => $token]) }}" />