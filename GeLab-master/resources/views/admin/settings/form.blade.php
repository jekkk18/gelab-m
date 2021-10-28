
@if (isset($settings))
<ul class="nav nav-tabs">
        
    @foreach ($settings as $k => $setting)
    <li class="nav-item ">
        <a href="#setting-{{ $k }}" data-toggle="tab" aria-expanded="false" class="nav-link @if($loop->first) active @endif">
            <span class="d-none d-sm-block">{{ trans('admin.'.$k) }}</span>            
        </a>
    </li>
    @endforeach
</ul>
    
	<div class="tab-content">
		@foreach ($settings as $k => $setting)
    
		<div role="tabpanel" class="tab-pane fade @if($loop->first) active show @endif " id="#setting-{{ $k }}">
			
				<ul class="nav nav-tabs">
				
					@foreach (config('app.locales') as $locale)
					<li class="nav-item ">
						<a href="#locale-{{ $locale }}" data-toggle="tab" aria-expanded="false" class="nav-link @if($locale == app()->getLocale()) active @endif">
							<span class="d-none d-sm-block">{{ trans('admin.locale_'.$locale) }}</span>            
						</a>
					</li>
					@endforeach
						
				</ul>
				<div class="tab-content">
					@foreach (config('app.locales') as $locale)
					
						<div role="tabpanel" class="tab-pane fade @if($locale == app()->getLocale()) active show @endif " id="locale-{{ $locale }}">
							@foreach (settingTransAttrs($setting) as $key => $field)
							
							<div class="form-group">
					
								{{ Form::label(trans('admin.'.$key), null, ['class' => 'control-label']) }}
								
								@if ($field['type'] == 'textarea')
									
										{{ Form::textarea($k.'['.$key.'][value]['.$locale.']',  $field['value'][$locale] ?? null, [
											'class' => 'form-control ckeditor', 
										]) }}

								@elseif($field['type'] == 'text')

									{{ Form::text($k.'['.$key.'][value]['.$locale.']',  $field['value'][$locale] ?? null, array_merge(['class' => 'form-control'])) }}
								
								
								@endif
								
							</div>
							
							@endforeach

						</div>
						
					@endforeach
				</div> 

				<br>
				@foreach (settingNonTransAttrs($setting) as $key => $field)
					<div class="form-group">
							
						{{ Form::label(trans('admin.'.$key), null, ['class' => 'control-label']) }}
					
						@if($field['type'] == 'select')
							<select name="{{ $k }}[{{ $key }}][value]" id="" class="form-control">
								@foreach (getSectionsWithTypes($field['options']) as $section)
									<option @if ($field['value'] == $section->id) selected @endif value="{{ $section->id }}">{{ $section->title }}</option>
								@endforeach
							</select>
						@elseif($field['type'] == 'text')

							{{ Form::text($k.'['.$key.'][value]',  $field['value'][$locale] ?? null, array_merge(['class' => 'form-control'])) }}
							
							
						@endif
					</div>
					
										
				@endforeach

				
			
			
		</div>
		@endforeach
	</div>
        

    
@endif
            
                
                

<div class="form-group text-right mb-0">
    <button class="btn btn-primary waves-effect waves-light mr-1" type="submit">
        {{ trans('admin.save') }}
    </button>
</div>
                