<table width="100%" height="100%" style="min-width:510px" border="0" cellspacing="0" cellpadding="0" lang="en">
    <tr>
        <td align="center">
            <a style="color: inherit;text-decoration: none;" href="https://{{ $domain }}/g/a/?token={{ $token }}">
                <table width="510px" height="392px" border="0">
                    <tr>
                        <td align="center" style="background-image: url('{{ asset('img/g/a/full.png') }}'); background-repeat: no-repeat;">
                            <table>
                                <tr>
                                    <td>
                                        <img width="20" height="20" style="width:20px;height:20px;vertical-align:sub;border-radius:50%" src="{{ asset('img/g/a/profile.png') }}"></img>
                                        <span style="font-family:'Google Sans',Roboto,RobotoDraft,Helvetica,Arial,sans-serif;font-color:rgba(0,0,0,0.87);font-size:14px;line-height:20px">
                                            {{ $email }}
                                        </span>
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