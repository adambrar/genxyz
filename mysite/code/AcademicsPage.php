<?php 
 
class AcademicsPage extends Page 
{
    
}
 
class AcademicsPage_Controller extends Page_Controller 
{
    private static $allowed_actions = array(
        'SearchForm',
        'search'
    );
    
    public function SearchAcademics()
    {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.DEFAULT',
                'Search all academics') . '</h2>'),
            new TextField('FirstName', _t(
                'MemberProfileForms.DEFAULT',
                'Name') . '<span>*</span>'),
            new TextField('MiddleName', _t(
                'MemberProfileForms.DEFAULT',
                'Program')),
            new TextField('Surname', _t(
                'MemberProfileForms.DEFAULT',
                'Field') . '<span>*</span>'),
            new DateField('DateOfBirth', _t(
                'MemberProfileForms.DEFAULT',
                'Country')),
            new CountryDropdownField('Nationality', _t(
                'MemberProfileForms.DEFAULT',
                'City')),
            new EmailField('Email', _t(
                'MemberProfileForms.DEFAULT',
                'Grades') . '<span>*</span>')
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'BasicProfileForm', $fields, $actions, $required);
    }
    
    public function FilterUniversities()
    {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.DEFAULT',
                'Filter Universities') . '</h2>'),
            new TextField('FirstName', _t(
                'MemberProfileForms.DEFAULT',
                'Name') . '<span>*</span>'),
            new TextField('MiddleName', _t(
                'MemberProfileForms.DEFAULT',
                'Program')),
            new CheckBoxField('Surname', _t(
                'MemberProfileForms.DEFAULT',
                'In Top 10') . '<span>*</span>'),
            new CheckBoxField('DateOfBirth', _t(
                'MemberProfileForms.DEFAULT',
                'Friendly')),
            new CountryDropdownField('Nationality', _t(
                'MemberProfileForms.DEFAULT',
                'Country'))
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'BasicProfileForm', $fields, $actions, $required);
    }
    
    public function FilterScholarships()
    {
        $fields = new FieldList(
            new LiteralField('LiteralHeader', '<h2>' . _t(
                'MemberProfileForms.DEFAULT',
                'Filter Scholarships') . '</h2>'),
            new TextField('FirstName', _t(
                'MemberProfileForms.DEFAULT',
                'Name') . '<span>*</span>'),
            new TextField('MiddleName', _t(
                'MemberProfileForms.DEFAULT',
                'Program')),
            new DropdownField('type', _t(
                'MemberProfileForms.DEFAULT',
                'Type') . '<span>*</span>', array('Lots of money', 'Medium money', 'No money')),
            new DropdownField('DateOfBirth', _t(
                'MemberProfileForms.DEFAULT',
                'Eligibility'), array('Young', 'Middle Age', 'Old')),
            new CountryDropdownField('Nationality', _t(
                'MemberProfileForms.DEFAULT',
                'Country'))
        );
        
        $actions = new FieldList(
            new FormAction('saveProfileForm', _t(
                'MemberProfileForms.DEFAULT',
                'Search'))
        );
        
        $required = new RequiredFields(array(
            'FirstName',
            'Surname',
            'Email'
        ));
        
        return new Form($this->owner, 'BasicProfileForm', $fields, $actions, $required);
    }
}