<!-- File WIP -->
    
            

            <!-- <aside class="notes">
                <h2>Notes:</h2>
                
                <ul>
                    <li>This is the exception to the rule of using native components in lieu of custom ones:

                        <ul>
                            <li>In Voiceover and Safari, this is reported as a text element.  This may be because Safari doesn't use
                                a date widget like other browsers, but it is misleading.
                            </li>
                            <li>In Chrome, the visual tab order is Year, Month, Date, but when tabbing through the component, the order is month date year.
                                Futhermore, if any of the values date is birth (i.e. the month, the date or the year) is blank, it reports a value as something
                                like "Nyahnyah".  I believe what is trying to say is "NaN", but I am not 100% sure.
                            </li>
                            <li>
                                In Firefox and NVDA, user is allowed to tab through the month, date, and year (in that order) and reports them to the users correctly
                                as spinners.  It would be nice, though, if it actually said the names of the months when the user cycles through them (it currently
                                reports them as numbers).
                            </li>
                            <li>

                            </li>
                        </ul>
                    </li>
                </ul>
                
            </aside> -->


        <h2>HTML5 date input example</h2>

        <div role="form" tabindex="-1">
            <fieldset>
                <legend id="contact">Contact Information</legend>
        
                <label for="dob">Date of Birth</label>
                <input id="dob" size="25" type="date">
        
                
        
            </fieldset>
        </div>
        
    