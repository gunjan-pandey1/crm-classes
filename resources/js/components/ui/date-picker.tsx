"use client"

import React, { useState, useEffect } from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import { CalendarIcon } from "lucide-react";
import { cn } from "@/lib/utils";
import { Button } from "@/components/ui/button";

interface DatePickerWithRangeProps extends React.HTMLAttributes<HTMLDivElement> {
  fromDate?: Date;
  toDate?: Date;
  onFromDateChange?: (date: Date | undefined) => void;
  onToDateChange?: (date: Date | undefined) => void;
  className?: string;
}

export function DatePickerWithRange(props: DatePickerWithRangeProps) {
  const { className, fromDate, toDate, onFromDateChange, onToDateChange } = props;
  const [startDate, setStartDate] = useState<Date | null>(fromDate || null);
  const [endDate, setEndDate] = useState<Date | null>(toDate || null);

  useEffect(() => {
    setStartDate(fromDate || null);
  }, [fromDate]);

  useEffect(() => {
    setEndDate(toDate || null);
  }, [toDate]);

  return (
    <div className={cn("flex items-center gap-2", className)}>
      <div className="relative">
        <DatePicker
          selected={fromDate}
          onChange={(date) => onFromDateChange?.(date || undefined)}
          selectsStart
          startDate={fromDate}
          endDate={toDate}
          dateFormat="MMM dd, yyyy"
          placeholderText="Start Date"
          className="w-[150px] rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
        />
        <CalendarIcon className="absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" />
      </div>
      <span className="text-sm text-gray-500">to</span>
      <div className="relative">
        <DatePicker
          selected={toDate}
          onChange={(date) => onToDateChange?.(date || undefined)}
          selectsEnd
          startDate={fromDate}
          endDate={toDate}
          minDate={fromDate}
          dateFormat="MMM dd, yyyy"
          placeholderText="End Date"
          className="w-[150px] rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
        />
        <CalendarIcon className="absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-gray-500" />
      </div>
    </div>
  );
}