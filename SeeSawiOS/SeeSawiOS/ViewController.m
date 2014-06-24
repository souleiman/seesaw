//
//  ViewController.m
//  SeeSawiOS
//
//  Created by Abdullah Sahyouni on 6/23/14.
//  Copyright (c) 2014 Agilex. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController


- (void)viewDidLoad
{
    [super viewDidLoad];
	// Do any additional setup after loading the view, typically from a nib.
    NSString *path = [[NSBundle mainBundle] pathForResource:@"config" ofType:@"plist"];
    NSDictionary *settings = [[NSDictionary alloc] initWithContentsOfFile:path];
    
    
    NSURL *url = [NSURL URLWithString:settings[@"seeSawWebView"]];
    NSURLRequest *requestObj = [NSURLRequest requestWithURL:url];
    [_seeSawWebView loadRequest:requestObj];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
