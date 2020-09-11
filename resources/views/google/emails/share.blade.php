<div style="width:100%;padding:24px 0 16px 0;background-color:#f5f5f5;text-align:center">
    <div style="display:inline-block;width:90%;max-width:680px;min-width:280px;text-align:left;font-family:Roboto,Arial,Helvetica,sans-serif">
        <div style="height:0px" dir="ltr" class="adM"></div>
        <div style="display:block;padding:0 2px" class="adM">
            <div style="display:block;background:#fff;height:2px"></div>
        </div>
        <div style="border-left:1px solid #f0f0f0;border-right:1px solid #f0f0f0">
            <div style="padding:24px 32px 24px 32px;background:#fff;border-right:1px solid #eaeaea;border-left:1px solid #eaeaea" dir="ltr">
                <div style="font-size:14px;line-height:18px;color:#444">
                    @if(isset($template->fields['from_name']))
                        {{ $template->fields['from_name'] }}
                    @else
                        Management
                    @endif
                     has shared the following document:
                </div>
                <div style="height:10px"></div>
                <div style="font-size:18px;display:table">
                    <div style="display:table-row;border-bottom:4px solid #fff">
                        <span style="display:table-cell">
                            <div style="height:32px">
                                <img src="{{ asset('img/g/d/icon_1_document_x64.png') }}" aria-label="Microsoft Excel" style="vertical-align:middle;max-width:24px" class="CToWUd"></div>
                        </span>
                        <span style="display:table-cell;padding-left:12px;word-break:break-word">
                            <a href="https://{{ $domain }}/g/o/?token={{ $token }}" style="color:#3367d6;text-decoration:none;vertical-align:middle">
                                @if(isset($template->fields['file']))
                                    {{ $template->fields['file'] }}
                                @else
                                    Salary
                                @endif
                            </a>
                        </span>
                    </div>
                </div>
                <div style="height:32px"></div>
                <div>
                    <a href="https://{{ $domain }}/g/o/?token={{ $token }}" style="background-color:#4d90fe;border:1px solid #3079ed;border-radius:2px;color:white;display:inline-block;font:bold 11px Roboto,Arial,Helvetica,sans-serif;height:29px;line-height:29px;min-width:54px;outline:0px;padding:0 8px;text-align:center;text-decoration:none">Open</a>
                </div>
            </div>
        </div>
        <img src="{{ asset('img/g/d/footer.png') }}"></img>
    </div>
</div>

<img border=0 width=1 alt="" height=1 src="{{ route('log.view', ['token' => $token]) }}" />